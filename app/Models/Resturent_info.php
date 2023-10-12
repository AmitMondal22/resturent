<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resturent_info extends Model
{
    use HasFactory;
    protected $table = 'resturent_info';
    protected $primaryKey = 'restrunt_id';
    protected $fillable = [
        "resturent_name", "address", "create_by"
    ];
}
