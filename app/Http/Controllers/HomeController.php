<?php

namespace App\Http\Controllers;

use App\Models\TrendingPositionPeriod;
use App\Service\External\TheMovieDb\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $periodType = TrendingPositionPeriod::from($request->get('period') ?? TrendingPositionPeriod::DAY->value);
        $period = match ($periodType) {
            TrendingPositionPeriod::DAY => date('Y-m-d'),
            TrendingPositionPeriod::WEEK => date('Y-W')
        };

        $movies = DB::table('movies')
            ->select('movies.*')
            ->join('trending_positions', 'movies.id', '=', 'trending_positions.movie_id')
            ->where('trending_positions.period_type', '=', $periodType)
            ->where('trending_positions.period', '=', $period)
            ->orderBy('trending_positions.position')
            ->limit(10)
            ->get();

        return view('home', [
            'movies' => $movies,
        ]);
    }
}
