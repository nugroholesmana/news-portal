<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelModel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'id',
        'thumbnail_artikel',
        'judul_artikel',
        'isi_artikel',
        'kategori_artikel',
        'tag_artikel',
        'created_at',
        'updated_at'
    ];
}
