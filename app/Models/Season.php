<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    
    use HasFactory;

    protected $primaryKey = 'season_id';
    protected $fillable = ['program_id', 'season_number', 'release_year', 'description'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'season_id', 'season_id');
    }
}
