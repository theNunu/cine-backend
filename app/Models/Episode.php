<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $primaryKey = 'episode_id';
    protected $fillable = ['season_id', 'episode_number', 'title', 'duration_minutes', 'synopsis', 'video_url'];

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'season_id');
    }
}
