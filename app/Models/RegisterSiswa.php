<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterSiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_register_siswa';
    protected $primaryKey = 'id_register_siswa';
    protected $guarded = [''];
}
