<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Product extends Model
{
    use HasFactory;

    protected $table = 'sales_products';

    protected $fillable = [
        'sales_id', 'product_id', 'price', 'quantity',
    ];

    
}
