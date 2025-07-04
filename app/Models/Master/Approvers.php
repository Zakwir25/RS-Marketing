<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvers extends Model
{
    use HasFactory;

    protected $table = 'rs_approvals';
    protected $guarded = ['id'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'initiator_nik', 'nik');
    }

    public function rs_masters()
    {
        return $this->belongsTo(RSMaster::class);
    }
}
