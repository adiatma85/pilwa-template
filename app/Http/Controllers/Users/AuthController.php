<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\SiamAuthTrait;

class AuthController extends Controller
{

    use SiamAuthTrait;

    public function login()
    {
        return view('users/SiamAuthLogin');
    }

    public function auth(Request $request)
    {
        $credentials = [
            'nim' => $request->nim,
            'password' => $request->password,
        ];
        return $this->siamAuth($credentials);
    }
}
