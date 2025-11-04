<?php

namespace App\Services;

use App\Repositories\ProgramRepository;

class ProgramService
{
    protected $programRepository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    public function getAll()
    {
        return $this->programRepository->all();
    }

    public function getByType($type)
    {
        return $this->programRepository->findByType($type);
    }

    public function getById($id)
    {
        return $this->programRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->programRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->programRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->programRepository->delete($id);
    }
}
