<?php

namespace App\Services;

use App\Repositories\SeasonRepository;

class SeasonService
{
    protected $seasonRepository;

    public function __construct(SeasonRepository $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function getAll()
    {
        return $this->seasonRepository->all();
    }

    public function getById($id)
    {
        return $this->seasonRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->seasonRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->seasonRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->seasonRepository->delete($id);
    }
}
