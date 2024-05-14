<?php

use App\Models\Movie;
use App\Models\TrendingPosition;
use App\Models\TrendingPositionPeriod;
use App\Service\External\TheMovieDb\Api as TheMovieDbApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:movies:get-trending', function (TheMovieDbApi $api): int {
    $this->output->title('Trending movies retrieval tool.');

    $requestedPeriod = TrendingPositionPeriod::from(
        $this->choice('Which period would you want to retrieve ?', [TrendingPositionPeriod::DAY->value, TrendingPositionPeriod::WEEK->value], 0));

    $movies = $api->getTrending($requestedPeriod->value);

    $bar = $this->output->createProgressBar(count($movies));

    $bar->start();

    foreach ($movies as $index => $movieData) {
        /** @var ?Movie $movie */
        if (null === ($movie = Movie::firstWhere('tmdb_id', $movieData['id']))) {
            $movie = Movie::create([
                'tmdb_id' => $movieData['id'],
                'title' => $movieData['title'],
                'overview' => $movieData['overview'],
                'poster' => $movieData['poster_path'],
                'cover' => $movieData['backdrop_path'],
                'release_date' => $movieData['release_date'],
            ]);
        }

        $period = match($requestedPeriod) {
            TrendingPositionPeriod::DAY => date('Y-m-d'),
            TrendingPositionPeriod::WEEK => date('Y-W'),
        };

        $trendingPeriod = $movie->trendingPositions()
            ->where('period_type', $requestedPeriod)
            ->where('period', $period)
            ->first();

        if (null === $trendingPeriod) {
            $trendingPosition = new TrendingPosition([
                'period_type' => $requestedPeriod->value,
                'period' => $period,
                'position' => $index + 1,
            ]);

            $movie->trendingPositions()->save($trendingPosition);
        }

        $bar->advance();
    }

    $bar->finish();
    $this->newLine(2);

    $this->info('Done !');

    return Command::SUCCESS;
})->purpose('Retrieves the last trending movies from The Movie DB API and stores them inside database.')->daily();
