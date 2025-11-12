<?php

namespace App\Models;

use App\Enums\ProgramType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    // protected $hidden = ['created_at', 'updated_at', 'pivot'];
    use HasFactory;

    protected $primaryKey = 'program_id';
    protected $fillable = [
        'title',
        'description',
        'type',
        'genre_id',
        'release_date',
        'cover_image',
        'release_year'
    ];

    // Si tu versión de Laravel soporta enum casting:
    protected $casts = [
        // Esto convertirá string <-> ProgramType enum automáticamente
        'type' => ProgramType::class,
        'release_date' => 'date',
    ];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'program_id', 'program_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'program_genres', 'program_id', 'genre_id');
        /*
            related: Genre::class,      // modelo relacionado
            table: 'program_genres',    // nombre de la tabla pivot
            foreignPivotKey: 'program_id',  // columna pivot que apunta al modelo actual (Program)
            relatedPivotKey: 'genre_id'     // columna pivot que apunta al modelo relacionado (Genre)
         */
    }
}
