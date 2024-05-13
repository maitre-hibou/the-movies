<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Service\External\TheMovieDbApi;
use Illuminate\Console\Command;

class RetrieveTrendingMovies extends Command
{
    public function __construct(
        private readonly TheMovieDbApi $api
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retrieve-trending-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the last 100 trending movies from The Movie DB API and stores them inside database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Trending movies retrieval tool.');

        $movies = $this->api->getTrending(
            $this->choice('Which period would you want to retrieve ?', ['day', 'week'], 0),
        );

        $bar = $this->output->createProgressBar(count($movies));

        $bar->start();

        foreach ($movies as $movie) {
            if (null === Movie::firstWhere('tmdb_id', $movie['id'])) {
                Movie::create([
                    'tmdb_id' => (string) $movie['id'],
                    'title' => $movie['title'],
                    'overview' => $movie['overview'],
                    'poster' => $movie['poster_path'],
                    'cover' => $movie['backdrop_path'],
                    'release_date' => $movie['release_date'],
                ]);
            }

            $bar->advance();
        }

        $bar->finish();

        $this->info('Done !');
    }
}
