<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselRequest;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Services\CarouselService;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    protected  $carouselService;
    public function __construct(CarouselService $carouselService)
    {
        $this->carouselService = $carouselService;
    }
    public function index()
    {
        return response()->json($this->carouselService->getAll());
    }

    public function store(CarouselRequest $request)
    {
        // return response()->json($carousel, 201);
        return response()->json($this->carouselService->create($request->validated()), 201);
    }

    // private function getMediaUrl($uuid)
    // {
    //     // Aquí podrías mapear el UUID a una ruta real, por ejemplo si lo tienes en storage:
    //     return url("/storage/media/{$uuid}.jpg");
    // }
}
