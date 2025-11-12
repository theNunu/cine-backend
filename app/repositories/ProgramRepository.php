<?php

namespace App\Repositories;

use App\Enums\ProgramType;
use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramRepository
{
    public function all()
    {
        //program has many seasons
        //seasons belong to program    
        //season has many episodes
        return Program::select('program_id', 'title', 'description', 'type')->with('seasons')->get();
    }

    public function findByType($type)
    {
        return Program::where('type', $type)->with('seasons')->get();
    }
    public function find($id)
    {
        return Program::with('seasons')->findOrFail($id);
    }

    public function create(array $data)
    {
        // dd($data);
        $program = Program::create($data);

        // sync para asignar muchos géneros
        $program->genres()->sync($data['genres']);

        // dd($program->load('genres'));

        // return $program->load('genres');
        $program->load('genres');

        return $program->makeHidden(['created_at', 'updated_at'])
            ->setRelation(
                'genres',
                $program->genres->makeHidden(['created_at', 'updated_at', 'pivot'])
            );
    }

    public function update($id, array $data)
    {
        $program = Program::findOrFail($id);
        $program->update($data);
        return $program;
    }

    public function delete($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return true;
    }

    public function getFiltered(?string $type = null, ?string $sortBy = 'release_year', ?string $order = 'desc'): Collection
    {
        $query = Program::query();

        // Validar tipo
        if ($type && in_array($type, ProgramType::values())) {
            $query->where('type', $type);
        }

        // Campos válidos para ordenar
        $validSorts = ['title', 'release_year', 'created_at'];

        if (!in_array($sortBy, $validSorts)) {
            $sortBy = 'release_year';
        }

        // Validar orden asc | desc
        $order = strtolower($order) === 'asc' ? 'asc' : 'desc';

        // ✅ Orden principal + secundaria (para estabilidad)
        return $query->orderBy($sortBy, $order)
                     ->orderBy('program_id', 'asc')
                     ->get();
    }
}
