## Wymagania

Nie wiem czy takie są, ale ja używałem takich wersji 
- node: `12.21`
- npm: `6.14`
- mysql: `8.0`

## Uruchomienie
Standardowo jak w laraverze
- Skopiuj .env z exampla i uzupelnij
- `git clone https://github.com/laradock/laradock.git`
- `cd laradock`
- `cp .env.example .env`
- Uzupelnij .env
- `docker-compose up -d workspace mysql nginx`
- `docker exec -it laradock_workspace_1 bash`
- `php artisan migrate`
- `php artisan key:generate`
- `php artisan jwt:secret`
- `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
- `npm install`
- `npm run dev/prod`

