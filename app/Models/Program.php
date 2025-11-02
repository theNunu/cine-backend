<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'program_id';
    protected $fillable = ['title', 'description', 'type', 'release_date', 'cover_image'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'program_id', 'program_id');
    }
}
