<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Td_billing extends Model
{
    use HasFactory;

    protected $table = 'td_billing';
    protected $primaryKey = 'id';
    protected $fillable = [
        "billing_id","customer_id","food_id","catagory_id", "price", "total_price", "qty", "resturent_id", "create_by"
    ];

}
