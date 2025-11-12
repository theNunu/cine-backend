<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Services\ProgramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    protected $programService;

    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->programService->getAll());
    }

    public function getMovies(): JsonResponse
    {
        return response()->json($this->programService->getByType('movie'));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->programService->getById($id));
    }

    public function store(ProgramRequest $request): JsonResponse
    {
        return response()->json($this->programService->create($request->validated()), 201);
    }

    public function update(ProgramRequest $request, $id): JsonResponse
    {
        return response()->json($this->programService->update($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        $this->programService->delete($id);
        return response()->json(['message' => 'Program deleted successfully']);
    }
    public function countByGenre($genre)
    {

        $count = $this->programService->countByGenre($genre);

        if ($count === null) {
            return response()->json([
                'message' => "No se encontró el género '{$genre}'"
            ], 404);
        }

        return $count;
    }
}
