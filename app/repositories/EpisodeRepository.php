<?php

namespace App\Repositories;

use App\Models\Episode;

class EpisodeRepository
{
    public function all()
    {
        return Episode::with('season')->get();
    }

    public function find($id)
    {
        return Episode::with('season')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Episode::create($data);
    }

    public function update($id, array $data)
    {
        $episode = Episode::findOrFail($id);
        $episode->update($data);
        return $episode;
    }

    public function delete($id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();
        return true;
    }
}
