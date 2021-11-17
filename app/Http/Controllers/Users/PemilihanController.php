<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Calon;
use App\Models\Pesertum;
use App\Models\Suara;
use Illuminate\Http\Request;

class PemilihanController extends Controller
{
    public function indexBem(Request $request)
    {
        $calonsBems = Calon::where('type', 'BEM')->get();
        return view('suara.presbem', compact('calonsBems'));
    }

    public function indexDpm(Request $request)
    {
        $calonsDpms = Calon::where('type', 'DPM')->get();
        return view('suara.dpm', compact('calonsDpms'));
    }

    public function storeBem(Request $request)
    {
        // Insert into peserta
        Pesertum::insert([
            'nim' => $request->session()->get('sub'),
        ]);
        // Insert into suara
        Suara::insert([
            'calon_id' => $request->calon_id,
            'type' => 'BEM',
        ]);

        // Redirect to dpm
        return redirect()->route('user.kotak-suara.indexDpm');
    }

    public function storeDpm(Request $request)
    {
        // Insert into peserta
        Pesertum::insert([
            'nim' => $request->session()->get('sub'),
        ]);
        // Insert into suara
        Suara::insert([
            'calon_id' => $request->calon_id,
            'type' => 'BEM',
        ]);

        // Redirect to after pemilihan
        return redirect()->route('user.kotak-suara.after');
    }
}
