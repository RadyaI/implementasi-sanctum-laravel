<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primarykey = 'id_siswa';
    protected $fillable = [
        'nama_siswa', 'gender', 'umur', 'id_kelas'
    ];
}
