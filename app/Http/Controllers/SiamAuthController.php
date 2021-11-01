<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\SiamAuthTrait;

class SiamAuthController extends Controller
{
    use SiamAuthTrait;

    public function auth(Request $request)
    {
        $credentials = [
            'nim' => $request->nim,
            'password' => $request->password,
        ];
        return $this->siamAuth($credentials);
    }
}
