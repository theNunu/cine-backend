<?php

namespace App\Repositories;

use App\Models\Program;

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
}
