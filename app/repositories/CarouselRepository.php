<?php

namespace App\Repositories;

use App\Models\Carousel;

class CarouselRepository
{
    public function all()
    {
        $carousels = Carousel::all()->map(function ($carousel) {
            $content = $carousel->content;

            // Convertimos los UUID a URLs (por ejemplo, imágenes)
            return [
                'id' => $carousel->carousel_id,
                'background_image_url' => $this->getMediaUrl($content['background_image_id']),
                'active_card_url' => $this->getMediaUrl($content['active_card_id']),
                'inactive_card_url' => $this->getMediaUrl($content['inactive_card_id']),
            ];
        });
        return $carousels;
    }

    private function getMediaUrl($uuid)
    {
        // Aquí podrías mapear el UUID a una ruta real, por ejemplo si lo tienes en storage:
        return url("/storage/media/{$uuid}.jpg");
    }

    public function create(array $data)
    {
        $carousel = Carousel::create([
            'content' => [
                'background_image_id' => $data['background_image_id'],
                'active_card_id' => $data['active_card_id'],
                'inactive_card_id' => $data['inactive_card_id'],
            ],
        ]);

        return $carousel;

    }
}
