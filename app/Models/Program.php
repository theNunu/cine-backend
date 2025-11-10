<?php

namespace App\Models;

use App\Enums\ProgramType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'program_id';
    protected $fillable = [
        'title',
        'description',
        'type',
        'genre_id',
        'release_date',
        'cover_image'
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

    // public function program_genre(): BelongsTo
    // {
    //     // Laravel asume la clave foránea user_id si no se especifica
    //     return $this->belongsTo(ProgramGenre::class);
    // }
    // public function genres()
    // {
    //     return $this->belongsToMany(Genre::class, 'program_genres');
    // }
    public function genres()
{
    return $this->belongsToMany(Genre::class, 'program_genres', 'program_id', 'genre_id');
}

}
