<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodikSiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_periodik_siswa';
    protected $primaryKey = 'id_periodik_siswa';
    protected $guarded = [''];
}
