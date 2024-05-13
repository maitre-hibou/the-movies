# The Movies

Sample movies listing application built with Laravel.

## Installation

> ⚠️ This project development stack is primarily made to run behind a Traefik reverse proxy. If you don't want to use it, simply uncomment line #12 in `docker-compose.yml`.

- Clone project
- Map domain `the-movies.local` to `127.0.0.1` in your hosts file.

Inside your project directory :

- Run `make start`
- Install project with `make install`

Access your project to [http://the-movies.local](http://the-movies.local)
