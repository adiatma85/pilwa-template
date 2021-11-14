<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPaslonRequest;
use App\Http\Requests\StorePaslonRequest;
use App\Http\Requests\UpdatePaslonRequest;
use App\Models\Paslon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PaslonController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('paslon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paslons = Paslon::all();

        return view('admin.paslons.index', compact('paslons'));
    }

    public function create()
    {
        abort_if(Gate::denies('paslon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paslons.create');
    }

    public function store(StorePaslonRequest $request)
    {
        $paslon = Paslon::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $paslon->id]);
        }

        return redirect()->route('admin.paslons.index');
    }

    public function edit(Paslon $paslon)
    {
        abort_if(Gate::denies('paslon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paslons.edit', compact('paslon'));
    }

    public function update(UpdatePaslonRequest $request, Paslon $paslon)
    {
        $paslon->update($request->all());

        return redirect()->route('admin.paslons.index');
    }

    public function show(Paslon $paslon)
    {
        abort_if(Gate::denies('paslon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paslons.show', compact('paslon'));
    }

    public function destroy(Paslon $paslon)
    {
        abort_if(Gate::denies('paslon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paslon->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaslonRequest $request)
    {
        Paslon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('paslon_create') && Gate::denies('paslon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Paslon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
