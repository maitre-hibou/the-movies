<?php

declare(strict_types=1);

namespace App\Service\External\TheMovieDb;

final class Utils
{
    public static function getImageUrl(string $imagePath, string $size = 'w500')
    {
        /** @var TheMovieDbApi $apiService */
        $apiService = app()->get(Api::class);

        return sprintf('%s%s/%s', $apiService->getConfiguration('images.secure_base_url'), $size, ltrim($imagePath, '/'));
    }
}
