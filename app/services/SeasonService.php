<?php

namespace App\Services;

use App\Enums\ProgramType;
use App\Models\Program;
use App\Repositories\SeasonRepository;
use Exception;

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
        // 1. Buscar el programa
        $program = Program::find($data['program_id']);
        // dd($program->type);

        if ($program->type !== ProgramType::Series) {
            throw new Exception("Solo se pueden agregar temporadas a programas de tipo 'series'.");
        }

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
