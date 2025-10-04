# User Management System (Laravel) - Clean Architecture

## Setup
1. Clone repo
2. Copy .env.example to .env and configure DB
3. composer install
4. php artisan key:generate
5. php artisan migrate
6. composer require spatie/laravel-permission pragmarx/google2fa-laravel
7. php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
8. php artisan vendor:publish --provider="PragmaRX\Google2FALaravel\ServiceProvider"

## Branching
- Use feature branches like `feature/auth-2fa`
- PR titles follow Conventional Commits (feat, fix, chore)

## Security
- Passwords hashed with `Hash::make`
- Rate limiting, validation, no raw queries

## Notes
- Admin user can be created in seeder and assigned `admin` role.
