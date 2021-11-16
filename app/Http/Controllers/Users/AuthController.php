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
        $request->session()->put('nim', $request->nim);
        return $this->siamAuth($credentials);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        // return view buat ucapin terima kasih telah berkontribusi
    }

    public function testingSessionAuth(Request $request)
    {
        return response()->json([
            'nim' => $request->session()->get('nim', 'nim kosong'),
        ]);
    }

    public function closeAuth(Request $request)
    {
        $request->session()->flush();
    }
}
