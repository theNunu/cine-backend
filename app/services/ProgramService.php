<?php

namespace App\Services;

use App\Enums\ProgramType;
use App\Models\Genre;
use App\Models\Program;
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
        // dd($data);
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

    public function countByGenre(string $genre)
    {

        $genre = Genre::where('name', strtoupper($genre))->first();
        // dd($genre);
        if (!$genre) {
            return null;
        }

        $res = $genre->programs()->count();
        // $res = $genre->count();


        return response()->json([
            'cantidad de programas' => $res
        ]);
    }

    public function getFilteredPrograms(?string $type, ?string $sortBy, ?string $order)
    {
        /*
            ASC → los muestra de menor a mayor → 2001 → 2005 → 2010 → 2020
            DESC → los muestra de mayor a menor → 2020 → 2010 → 2005 → 2001
         */
        // $programs = $this->programRepository->getFiltered($type, $sortBy, $order);

        // return $programs->map(function ($program) {
        //     return [
        //         'program_id' => $program->program_id,
        //         'title' => $program->title,
        //         'type' => $program->type,
        //         'release_year' => $program->release_year,
        //     ];
        // });

        $query = Program::query();

        if ($type && in_array($type, ProgramType::values())) {
            $query->where('type', $type);
        }

        $validSorts = ['title', 'release_year', 'created_at'];

        if (!in_array($sortBy, $validSorts)) {
            $sortBy = 'release_year';
        }

        $order = strtolower($order) === 'asc' ? 'asc' : 'desc';

        // Trae los resultados sin ordenar (ya que los ordenaremos después del map)
        $programs = $query->get();

        // Mapear los campos que quieres mostrar
        $mapped = $programs->map(function ($program) {
            return [
                'program_id' => $program->program_id,
                'title' => $program->title,
                'type' => $program->type,
                'release_year' => $program->release_year,
            ];
        });

        // Ordenar después del map
        //return $order === 'desc'
        return $order === 'asc'
            ? $mapped->sortBy($sortBy)->values()
            : $mapped->sortByDesc($sortBy)->values();
    }
}
