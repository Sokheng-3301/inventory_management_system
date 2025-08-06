<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cat_name',
        'add_by',
        'create_date',
        'delete_status',
        'delete_by',
        'delete_date',
        'year'
    ];
}
