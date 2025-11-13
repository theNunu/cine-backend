<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Carousel extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($carousel) {
            $carousel->carousel_id = (string) Str::uuid();
        });
    }

    protected $casts = [
        'content' => 'array', // convierte automáticamente JSON a array
    ];
}
