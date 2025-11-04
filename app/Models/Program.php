<?php

namespace App\Models;

use App\Enums\ProgramType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'program_id';
    protected $fillable = [
        'title',
        'description',
        'type',
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
}
