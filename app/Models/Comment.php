<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
   protected $guarded = ['id'];

   public function buku(): BelongsTo
   {
      return $this->belongsTo(Buku::class, 'buku_id');
   }

   public function parent(): BelongsTo
   {
      return $this->belongsTo(Comment::class, 'parent_id');
   }

   public function replies(): HasMany
   {
      return $this->hasMany(Comment::class, 'parent_id');
   }
}
