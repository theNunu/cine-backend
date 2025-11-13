<?php

namespace App\Services;

use App\Repositories\CarouselRepository;


class CarouselService
{

    protected $carouselRepository;

    public function __construct(CarouselRepository $carouselRepository)
    {
        $this->carouselRepository = $carouselRepository;
    }

    public function getAll()
    {
        return $this->carouselRepository->all();
    }

    public function create(array $data)
    {
        return $this->carouselRepository->create($data);
    }
}
