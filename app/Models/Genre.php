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

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_genres', 'genre_id', 'program_id');
        /*
            related: Genre::class,      // modelo relacionado
            table: 'program_genres',    // nombre de la tabla pivot
            foreignPivotKey: 'program_id',  // columna pivot que apunta al modelo actual (Genre)
            relatedPivotKey: 'genre_id'     // columna pivot que apunta al modelo relacionado (Program)
         */
    }
}
