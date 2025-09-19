<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignable).
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * Kolom yang harus disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting otomatis untuk kolom tertentu.
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public $timestamps = false;
}
