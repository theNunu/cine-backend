<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOne;

// class ProgramGenre extends Model
// {
//     //
//     use HasFactory;

//     protected $primaryKey = 'program_genres_id';
//     protected $fillable = [
//         'name',
//         'description',
//     ];

//     // Si tu versión de Laravel soporta enum casting:
//     protected $casts = [];

//     public function program(): HasOne
//     {
//         // Laravel asume la clave foránea user_id si no se especifica
//         return $this->hasOne(Program::class);
//     }
// }
