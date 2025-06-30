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

    public function naskah()
    {
        return $this->belongsTo(Naskah::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'buku_id')->whereNull('parent_id')->where('is_approved', true)->latest();
    }
}
