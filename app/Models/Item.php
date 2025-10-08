<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'NamaProduk',
        'Jenis',
        'Satuan',
        'JumlahProduk',
        'Harga',
        'cover',
    ];

    /**
     * Menggunakan 'slug' sebagai key untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}