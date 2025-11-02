<?php

namespace App\Services;

use App\Repositories\EpisodeRepository;

class EpisodeService
{
    protected $episodeRepository;

    public function __construct(EpisodeRepository $episodeRepository)
    {
        $this->episodeRepository = $episodeRepository;
    }

    public function getAll()
    {
        return $this->episodeRepository->all();
    }

    public function getById($id)
    {
        return $this->episodeRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->episodeRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->episodeRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->episodeRepository->delete($id);
    }
}
