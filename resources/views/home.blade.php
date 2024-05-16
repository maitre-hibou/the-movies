<x-default-layout>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ config('app.name') }}</h1>
                <p class="lead text-body-secondary">A small collection of trending movies.</p>
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Time period</a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?period=day">Today</a></li>
                        <li><a class="dropdown-item" href="?period=week">This Week</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 g-3">
                @foreach($movies as $movie)
                    <div class="col">
                        <a class="card mb-3" href="{{ route('movie.show', ['id' => $movie->id]) }}" style="max-width: 540px; text-decoration: none">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ App\Service\External\TheMovieDb\Utils::getImageUrl($movie->poster, 'w500')}}" class="img-fluid rounded-start" alt="{{ $movie->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ substr($movie->title, 0, strpos(wordwrap($movie->overview, 45), "\n")) . ' ...' }}</h5>
                                        <p class="card-text">
                                            {{ substr($movie->overview, 0, strpos(wordwrap($movie->overview, 120), "\n")) . ' ...' }}
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-default-layout>
