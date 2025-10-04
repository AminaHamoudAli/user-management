<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\EloquentUserRepository;

class UseCaseServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }
    public function boot() {}
}
