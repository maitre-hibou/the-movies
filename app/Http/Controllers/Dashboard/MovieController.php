<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\View\View;

final class MovieController extends Controller
{
    public function list(): View
    {
        $totalMoviesPage = ceil(Movie::count() / 10);
        $movies = Movie::paginate(10);

        return view('dashboard.movies.list', [
            'movies' => $movies,
            'totalMoviesPage' => $totalMoviesPage,
        ]);
    }
}
