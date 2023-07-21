<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasOrtu extends Model
{
    use HasFactory;
    protected $table = 'tb_identitas_orangtua';
    protected $primaryKey = 'id_identitas_orangtua';
    protected $guarded = [''];
}
