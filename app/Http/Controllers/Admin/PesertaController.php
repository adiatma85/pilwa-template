<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPesertumRequest;
use App\Http\Requests\StorePesertumRequest;
use App\Http\Requests\UpdatePesertumRequest;
use App\Models\Pesertum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PesertaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pesertum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peserta = Pesertum::all();

        return view('admin.peserta.index', compact('peserta'));
    }

    public function create()
    {
        abort_if(Gate::denies('pesertum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.create');
    }

    public function store(StorePesertumRequest $request)
    {
        $pesertum = Pesertum::create($request->all());

        return redirect()->route('admin.peserta.index');
    }

    public function edit(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.edit', compact('pesertum'));
    }

    public function update(UpdatePesertumRequest $request, Pesertum $pesertum)
    {
        $pesertum->update($request->all());

        return redirect()->route('admin.peserta.index');
    }

    public function show(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.show', compact('pesertum'));
    }

    public function destroy(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pesertum->delete();

        return back();
    }

    public function massDestroy(MassDestroyPesertumRequest $request)
    {
        Pesertum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
