<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $fillable = ['nama', 'slug'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
