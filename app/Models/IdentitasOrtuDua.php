<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasOrtuDua extends Model
{
    use HasFactory;
    protected $table = 'tb_identitas_orangtua_dua';
    protected $primaryKey = 'id_identitas_orangtua_dua';
    protected $guarded = [''];
}
