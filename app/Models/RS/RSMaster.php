<?php

namespace App\Models\RS;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RS\RSItem;
use App\Models\Revisions;
use App\Models\User;

class RSMaster extends Model
{
    use HasFactory;
    protected $table='rs_masters';
    protected $guarded=['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function rs_items()
    {
        return $this->hasMany(RSItem::class, 'rs_id');
    }

    public function revisions()
    {
        return $this->belongsTo(Revisions::class, 'revision_id', 'id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_nik', 'nik');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function department()
    {
        return $this->belongsTo(User::class, 'department_id', 'id');
    }
}
