# The Movies

Sample movies listing application built with Laravel.

## Installation

> ⚠️ This project development stack is primarily made to run behind a Traefik reverse proxy. If you don't want to use it, simply uncomment line #12 in `docker-compose.yml`.

- Clone project
- Map domain `the-movies.local` to `127.0.0.1` in your hosts file.

Inside your project directory :

- Run `make prepare` to initialize packages installation and `.env` file.
- In your `.env` file, insert your themoviedb.org API key in the variable `THEMOVIEDB_API_KEY`
- Run `make start`
- Install project with `make install`

Access your project to [http://the-movies.local](http://the-movies.local)

## Pulling trending movies

To visualize movies on the front page, it is necessary to pull data from TheMovieDb.org API.

To do so, there is an artisan command :

`./vendor/bin/sail artisan app:movies:get-trending`

Run it and choose whether you want movies trending for the day, or the week.

Once it is done, you will be able to see movies on the front page depending on the time period you selected.
