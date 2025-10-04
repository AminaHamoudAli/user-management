<?php
namespace App\Infrastructure\Persistence\Eloquent;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface {
    public function create(array $data): User {
        return User::create($data);
    }
    public function findByEmail(string $email): ?User {
        return User::where('email', $email)->first();
    }
    public function findById($id): ?User {
        return User::find($id);
    }
    public function update(User $user, array $data): User {
        $user->update($data);
        return $user;
    }
}
