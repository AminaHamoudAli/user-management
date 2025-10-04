<?php
namespace App\UseCases\Auth;

use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterUser {
    private $users;

    public function __construct(UserRepositoryInterface $users) {
        $this->users = $users;
    }

    public function execute(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->users->create($data);
    }
}
