<?php

namespace App\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @return string
     */
    public function generateToken():string
    {
        return auth()->user()->createToken('tokens')->plainTextToken;
    }

    public function removeToken()
    {
        auth()->user()->tokens()->delete();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $image
     * @return Builder|Model
     */
    public function createUser(
        string $name,
        string $email,
        string $password,
        string $image
    ) {
        $user = User::query()->create([
            'name' => $name,
            'password' => bcrypt($password),
            'email' => $email,
            'image' => $image
        ]);
        auth()->setUser($user);
        return $user;
    }
}
