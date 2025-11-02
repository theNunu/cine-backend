<?php

namespace App\Repositories;

use App\Models\Season;
use Illuminate\Cache\RetrievesMultipleKeys;

class SeasonRepository
{
    public function all()
    {
        //season belongs to program
        //season has many episodes

        // return Season::with('episodes')->get();

        // return Season::with(['program', 'episodes'])->get();

        $seasons = Season::with(['program', 'episodes'])->get();


        return $seasons->map(function ($season) {
            return [
                'season_id'     => $season->season_id,
                'season_number' => $season->season_number,
                'description'   => $season->description,
                'program' => [
                    'program_id'  => $season->program->program_id,
                    'title'       => $season->program->title,
                    'type'        => $season->program->type,
                    'description' => $season->program->description,
                ],
                'episodes' => $season->episodes->map(function ($episode) {
                    return [
                        'episode_id'  => $episode->episode_id,
                        'title'       => $episode->title,
                        'video_url'   => $episode->video_url,
                    ];
                }),
            ];
        });

        // return $seasons->map(function ($season) {
        //     return [
        //         'season_id'     => $season->season_id,
        //         'season_number' => $season->season_number,
        //         'description'   => $season->description,
        //         'program' => [
        //             'program_id'  => $season->program->program_id,
        //             'title'       => $season->program->title,
        //             'type'        => $season->program->type,
        //             'description' => $season->program->description,
        //         ],
        //         'episodes' =>  [
        //             'episode_id'  => $season->episodes->episode_id,
        //             'title'       => $season->episodes->title,
        //             'video_url'   => $season->episodes->video_url,
        //         ],

        //     ];
        // });

        // return $filtered;
    }

    public function find($id)
    {
        return Season::with(['program', 'episodes'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Season::create($data);
    }

    public function update($id, array $data)
    {
        $season = Season::findOrFail($id);
        $season->update($data);
        return $season;
    }

    public function delete($id)
    {
        $season = Season::findOrFail($id);
        $season->delete();
        return true;
    }
}
