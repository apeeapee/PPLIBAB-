<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_toko',
        'deskripsi_singkat',
        'nama_pic',
        'no_hp_pic',
        'no_ktp_pic',
        'email_pic',
        'alamat_pic',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'provinsi',
        'kota',
        'kode_pos',
        'status',
        'rejection_reason',
        'foto_pic',
        'file_ktp_pic',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
