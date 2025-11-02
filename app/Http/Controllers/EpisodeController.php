<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Http\Requests\SeasonRequest;
use App\Services\EpisodeService;
use App\Services\SeasonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
   
    protected $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->episodeService->getAll());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->episodeService->getById($id));
    }

    public function store(EpisodeRequest $request): JsonResponse
    {
        return response()->json($this->episodeService->create($request->validated()), 201);
    }

    public function update(EpisodeRequest $request, $id): JsonResponse
    {
        return response()->json($this->episodeService->update($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        $this->episodeService->delete($id);
        return response()->json(['message' => 'Episode deleted successfully']);
    }
}
