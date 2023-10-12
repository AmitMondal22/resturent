<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_unit_mastar extends Model
{
    use HasFactory;

    protected $table = 'md_unit_mastar';
    protected $primaryKey = 'unit_id';
    protected $fillable = [
        "resturent_id", "unit_name", "create_by"
    ];
}
