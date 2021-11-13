<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySuaraRequest;
use App\Http\Requests\StoreSuaraRequest;
use App\Http\Requests\UpdateSuaraRequest;
use App\Models\Calon;
use App\Models\Pesertum;
use App\Models\Suara;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuaraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('suara_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suaras = Suara::with(['calon', 'peserta'])->get();

        return view('admin.suaras.index', compact('suaras'));
    }

    public function create()
    {
        abort_if(Gate::denies('suara_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calons = Calon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pesertas = Pesertum::pluck('nim', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suaras.create', compact('calons', 'pesertas'));
    }

    public function store(StoreSuaraRequest $request)
    {
        $suara = Suara::create($request->all());

        return redirect()->route('admin.suaras.index');
    }

    public function edit(Suara $suara)
    {
        abort_if(Gate::denies('suara_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calons = Calon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pesertas = Pesertum::pluck('nim', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suara->load('calon', 'peserta');

        return view('admin.suaras.edit', compact('calons', 'pesertas', 'suara'));
    }

    public function update(UpdateSuaraRequest $request, Suara $suara)
    {
        $suara->update($request->all());

        return redirect()->route('admin.suaras.index');
    }

    public function show(Suara $suara)
    {
        abort_if(Gate::denies('suara_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suara->load('calon', 'peserta');

        return view('admin.suaras.show', compact('suara'));
    }

    public function destroy(Suara $suara)
    {
        abort_if(Gate::denies('suara_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suara->delete();

        return back();
    }

    public function massDestroy(MassDestroySuaraRequest $request)
    {
        Suara::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
