<?php

namespace App\Http\Controllers\Rs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Approver;
use App\Models\RS\RSMaster;
use App\Models\RS\RSItem;
use App\Models\Item\Itemmaster;
use App\Models\Customer;
use App\Models\User;
use App\Models\RsApproval;
use App\Models\Item\Itemdetail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendRsApprovalEmail;


class RequistionSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $req = RSMaster::get();
        return \view('page.rs.list-rs',compact('req'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Itemmaster::all();
        $customers = Customer::all();
        $initiators = User::all();
        return \view('page.rs.submitform-rs',compact('items','customers','initiators'));

    }

    public function noReg()
    {
        $year = date('y');
        $prefix = "{$year}RS";
        $lastRs = RsMaster::where('rs_no', 'like', "{$prefix}%")->orderBy('rs_no', 'desc')->first();

        if ($lastRs) {
            $lastNo = (int)substr($lastRs->rs_no, -4);
            $newNo = $lastNo + 1;
        } else {
            $newNo = 1;
        }

        do {
            $newNoReg = $prefix . str_pad($newNo, 4, '0', STR_PAD_LEFT);
            $existingRs = RsMaster::where('rs_no', $newNoReg)->first();
            if ($existingRs) {
                $newNo++;
            }
        } while ($existingRs);

        return response()->json(['rs_no' => $newNoReg]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rsItems = RSItem::with('item_detail')
            ->get();
        dd($request->all(), $rsItems);

       try{
        $request->validate([
            'rs_no' => 'required|string|max:50',
            'category' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'objectives' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:255',
            'account' => 'required|string|max:50',
            'cost_center' => 'nullable|string|max:50',
            'batch_code' => 'nullable|string|max:50',
            'revision_id' => 'required|string|max:50',
            'rs_number' => 'nullable|string|max:50|',
            'est_potential' => 'nullable|string|max:50',
            'date' => 'required|date',
            'initiator_nik' => 'required|string|max:50',
            'route_to' => 'nullable|string|max:50',


        ]);

        $initiator = $request->input('initiator_nik');
        $initiator = User::where('nik', $initiator)->first();
        if (!$initiator) {
            return response()->json(['error' => 'Invalid approver'], 422);
        }

        $approver = null;
        $userRole = $initiator->getRoleNames(); 
        foreach ($userRole as $role) {
            $approverRole = Approver::where('role', $role)->where('level', 1)->first();
            if ($approverRole) {
                $approver = User::where('nik', $approverRole->nik)->first();
                if ($approver) break;
            }
        }
        Log::info('Approver found', [
            'approver' => $approver ? $approver->name : 'none',
            'initiator' => $initiator->nik
        ]);
        
        
        // Mulai transaction untuk memastikan integritas data
        $rsMaster = RSMaster::create([
            'rs_no' => $request->input('rs_no'),
            'category' => $request->input('category'),
            'customer_id' => $request->input('customer_id'),
            'address' => $request->input('address'),
            'objectives' => $request->input('objectives'),
            'reason' => $request->input('reason'),
            'account' => $request->input('account'),
            'cost_center' => $request->input('cost_center'),
            'batch_code' => $request->input('batch_code'),
            'revision_id' => $request->input('revision_id'),
            'rs_number' => $request->input('rs_number'),
            'est_potential' => $request->input('est_potential'),
            'date' => $request->input('date'),
            'initiator_nik' => $initiator->nik,
            'route_to' => $approver ? $approver->nik : null,
            'status' => 'pending'
        ]);

        foreach ($request->input('item_detail_code') as $key => $itemDetailCode) {
            $itemDetailId = $request->input('item_detail_id')[$key];
            $qtyReq = $request->input('qty_req')[$key];
            $qtyIssued = $request->input('qty_issued')[$key];


            // Create RSItem for each item
            RSItem::create([
                'rs_id' => $rsMaster->id,
                'item_id' => $itemDetailId,
                'qty_req' => $qtyReq,
                'qty_issued' => $qtyIssued,   
                
            ]);
        }
        $rsItems = RSItem::with('item_detail')
            ->where('rs_id', $rsMaster->id)
            ->get();
        // Generate token
        $uniqueToken = (string) Str::uuid();
        $approvalToken = Crypt::encryptString($rsMaster->rs_no . '|' . $uniqueToken . '|approve');
        $rejectToken = Crypt::encryptString($rsMaster->rs_no . '|' . $uniqueToken . '|reject');
        
        // Dispatch Job
        if ($approver) {
            Log::info('Dispatching SendRsApprovalEmail job', [
                'approver' => $approver->id,
                'rsMaster' => $rsMaster->id,
                
                'approvalToken' => $approvalToken,
                'rejectToken' => $rejectToken
            ]);
            dispatch(new SendRsApprovalEmail($approver, $rsMaster, $rsItems, $approvalToken, $rejectToken));
        }

        $user = Auth::user();
        activity()
        ->performedOn($form)
            ->inLog('RS')
            ->event('Create')
            ->causedBy($user)
            ->withProperties(['no' => $rsMaster['rs_no'], 'action' => 'created'])
            ->log('Create Requisition Form ' . $request->input('rs_no') . ' by ' . (Auth::user() ? Auth::user()->name : 'unknown') . ' at ' . now());



         //sweet alert
        Alert::success('Success', 'Requisition Slip has been created successfully');
        return redirect()->route('rs.index')->with('success', 'Requisition Slip has been created successfully');
         } catch (\Exception $e) {
            \dd($e);
                // Jika terjadi kesalahan, rollback transaction
                return response()->json(['error' => 'Failed to create Requisition Slip: ' . $e->getMessage()], 500);
          }
    }

    /**
     * Display the specified resource.
     */
    public function showlist(string $id)
    {

       return view('page.rs.form-list-rs');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        confirmDelete();
        return \view('page.rs.edit-rs')->with('id', $id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'rs_number' => 'nullable|string|max:50|unique:rs_masters,rs_number,' . $id,
            'objectives' => 'required|string|max:255',
            'account' => 'required|string|max:50',
            'cost_center' => 'required|string|max:50',
            'form_no' => 'required|string|max:50',
            'revision' => 'required|string|max:50',
            'date' => 'required|date',
        ]);

        $req = RSMaster::findOrFail($id);
        $req->update($request->all());

        return redirect()->route('rs.index')->with('success', 'Requisition Slip succesfully updated');
    }

    /**p
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $req = RSMaster::findOrFail($id);
        $req->delete();

        return redirect()->route('rs.index')->with('success', 'Requisition Slip succesfully Deleted');
    }

    public function report()
    {
        return view('page.rs.report-rs');
    }

    public function approval()
    {
        return view('page.rs.approval-rs');
    }

    public function log()
    {
        return view('page.rs.log-rs');
    }

    public function list($id)
    {
        $master = RSMaster::with('rs_items')->findOrFail($id);
    
    
        return view('page.rs.form-list-rs', compact('master'));
    }

    

    public function getFormList()
    {
        $user = Auth::user();
        $formList = null;
        $query = RSMaster::with('initiator','revisions', 'customer', 'rs_items.item_detail', 'customer');
        /** @var User $user */
        if ($user->hasRole('super-admin')) {
            $formList = $query->get();
        } else{
            $formList = $query->where('customer_id', $user->id)->get();
        }
        if($formList){
            $formList = $formList->map(function($item) {
                /** @var RSMaster $item */
                $item->new_created_at = $item->created_at->format('j F Y');
                return $item;
            });
            return response()->json($formList);
        }

        return response()->json("No data found");
    }


    public function statusform()
    {
        return view('page.rs.formstatus-rs');
    }

    public function submitform()
{
    return view('page.rs.submitform-rs');
}

public function getproductdata($id, Request $request)
{

    $types = $request->input('types');

    $item = Itemdetail::where('item_master_id', $id);


    if ($types) {
        $item->where('type', $types);
    }
    $item = $item->get();
    if ($item) {
        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Item not found'
        ]);
    }
}

   public function print($no)
    {
        $form = RSMaster::with('initiator','revisions', 'customer', 'rs_items.item_detail', 'customer')->where('rs_no', $no)->first();
        if (!$form) {
            return redirect()->back()->with('error', 'Requisition Slip not found');
        }
        
        return view('page.rs.print-rs', compact('form'));
    }
    
}
