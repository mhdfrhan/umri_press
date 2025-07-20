<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $guarded = ['id'];
    protected $with = ['buku'];

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'author_buku', 'author_id', 'buku_id');
    }
}
