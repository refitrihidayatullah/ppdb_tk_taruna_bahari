<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasSiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_identitas_siswa';
    protected $primaryKey = 'id_identitas_siswa';
    protected $guarded = [''];
}
