<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'pro_img',
        'pro_id',
        'pro_name_en',
        'pro_name_kh',
        'pro_code',
        'cat_id',
        'qty',
        'stock_status',
        'pro_description',
        'add_by',
        'delete_status',
        'delete_by',
        'year'
    ];


    // public function category(){
    //     return $this->belongsTo(Category::class, 'id');

    // } 
}

