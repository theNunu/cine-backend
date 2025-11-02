<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use App\Services\SeasonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
        protected $seasonService;

    public function __construct(SeasonService $seasonService)
    {
        $this->seasonService = $seasonService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->seasonService->getAll());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->seasonService->getById($id));
    }

    public function store(SeasonRequest $request): JsonResponse
    {
        return response()->json($this->seasonService->create($request->validated()), 201);
    }

    public function update(SeasonRequest $request, $id): JsonResponse
    {
        return response()->json($this->seasonService->update($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        $this->seasonService->delete($id);
        return response()->json(['message' => 'Season deleted successfully']);
    }
}
