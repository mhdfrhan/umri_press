<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $guarded = ['id'];
    protected $with = ['buku'];

    public function buku() {
        return $this->hasMany(Buku::class, 'author_id');
    }
}
