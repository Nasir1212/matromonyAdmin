<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class other_info extends Model
{
    use HasFactory;
    public $table='other_info';
    public $incrementing = true;
    public $keyType = 'int';
    public $primaryKey = 'id';
    public $timestamps = false;
}
