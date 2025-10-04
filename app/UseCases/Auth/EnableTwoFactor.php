<?php
namespace App\UseCases\Auth;

use PragmaRX\Google2FAQRCode\Google2FA;
use App\Interfaces\Repositories\UserRepositoryInterface;

class EnableTwoFactor {
    private $users;
    public function __construct(UserRepositoryInterface $users) {
        $this->users = $users;
    }

    public function execute($user) {
        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();
        $user = $this->users->update($user, [
            'google2fa_secret' => encrypt($secret),
            'two_factor_enabled' => true,
        ]);
        // return secret to user to show QR
        return $secret;
    }
}
