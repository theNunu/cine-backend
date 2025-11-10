<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Genre extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'genre_id';
    protected $fillable = [
        'name',
        'description'
    ];

    // public function programs()
    // {
    //     return $this->belongsToMany(Program::class, 'program_genres');
    // }
    public function programs()
{
    return $this->belongsToMany(Program::class, 'program_genres', 'genre_id', 'program_id');
}

}
