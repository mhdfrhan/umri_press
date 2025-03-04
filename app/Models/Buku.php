<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;

    protected $table = 'buku';
    protected $guarded = ['id'];
    protected $with = ['kategori'];

    public function naskah() {
        return $this->belongsTo(Naskah::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
