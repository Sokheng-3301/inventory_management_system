<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $borrowing = [
        'pro_id',	
        'staff_id'	,
        'borrow_date'	,
        'borrow_purpose'	,
        'borrow_qty'	,
        'borrow_status'	,
        'approve_by'	,
        'owner'	,
        'payback_date'	,
        'payback_status'	,
        'delete_status'	,
        'delete_by'	,
        'delete_date',	
        'year',
        'notification'	
    ];
}
