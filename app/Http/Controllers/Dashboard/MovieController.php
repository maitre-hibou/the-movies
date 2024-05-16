<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\View\View;

final class MovieController extends Controller
{
    public function list(): View
    {
        $movies = Movie::all();

        return view('dashboard.movies.list', [
            'movies' => $movies,
        ]);
    }
}
