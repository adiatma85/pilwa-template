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
        $itemStatusAuth = $this->siamAuth($credentials);

        // If wrong
        if (!$itemStatusAuth->success) {
            return redirect()->route('user.login');
        }

        // If guduk arek fk
        if ($itemStatusAuth->data['fakultas'] != 'Kedokteran' && !env('APP_DEBUG')) {
            return redirect()->route('user.login');
        }

        // Set session
        $request->session()->put('sub', $request->nim);

        // Set to index bem
        return redirect()->route('user.kotak-suara.indexBem');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
    }

    public function testingSessionAuth(Request $request)
    {
        return response()->json([
            'nim' => $request->session()->get('nim', 'nim kosong'),
        ]);
    }
}
