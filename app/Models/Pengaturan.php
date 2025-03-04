<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $fillable = ['key', 'value', 'display_name', 'type', 'group', 'keterangan'];

}
