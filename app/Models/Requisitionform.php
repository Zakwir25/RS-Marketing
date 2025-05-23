<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisitionform extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'address', 'rs_number', 'objectives', 
        'account', 'cost_center', 'form_no', 'revision', 'date'
    ];
}
