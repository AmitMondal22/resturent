<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_catagory extends Model
{
    use HasFactory;


    protected $table = 'md_catagory';
    protected $primaryKey = 'catagory_id';
    protected $fillable = [
        "catagory_name", "resturent_id", "create_by"
    ];
}
