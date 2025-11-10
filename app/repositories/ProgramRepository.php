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
        // // dd($data);
        // $program = Program::create($data);
        // dd($program, $data);
        //  // sync para asignar muchos géneros
        // $program->genres()->sync($data['genres']);
        // return  $program->load('genres');
        $program = Program::create($data);

        // sync para asignar muchos géneros
        $program->genres()->sync($data['genres']);

        return $program->load('genres');
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
