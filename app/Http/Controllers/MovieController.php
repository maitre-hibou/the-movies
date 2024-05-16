<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Service\External\TheMovieDb\Utils;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class MovieController extends Controller
{
    public function show(Request $request, string $id): View
    {
        $movie = Movie::find($id);

        return view('movie.show', [
            'movie' => $movie,
            'coverImageUrl' => Utils::getImageUrl($movie->cover, 'original'),
        ]);
    }
}
