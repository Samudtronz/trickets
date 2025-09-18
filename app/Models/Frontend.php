<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
      protected $table = 'konten_texts';
    
    protected $fillable = [
        'key',
        'value',
    ];

    public $timestamps = false;
}
