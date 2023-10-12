<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_food extends Model
{
    use HasFactory;
    //md_food
    protected $table = 'md_food';
    protected $primaryKey = 'food_id';
    protected $fillable = [
        "food_name", "food_price", "unit_id","catagory_id", "resturent_id", "created_by"
    ];
}
