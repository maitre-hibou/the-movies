<x-default-layout>
    <section class="py-5 text-center" style="background-position: center center; background-size: cover; background-image: url({{ $coverImageUrl }});">
        <div class="container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">{{ $movie->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container" style="max-width: 60em">
            <div class="row">
                <div class="col-3">
                    <img src="{{ App\Service\External\TheMovieDb\Utils::getImageUrl($movie->poster, 'w500') }}" alt="" class="mw-100">
                </div>
                <div class="col-9">
                    <p class="lead">{{$movie->overview}}</p>

                    <p class="txt-right"><a href="{{ route('home') }}">Back</a></p>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
