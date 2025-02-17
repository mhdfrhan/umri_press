<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;

    protected $table = 'buku';
    protected $guarded = ['id'];

    public function naskah() {
        return $this->belongsTo(Naskah::class);
    }
}
