<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCalonRequest;
use App\Http\Requests\StoreCalonRequest;
use App\Http\Requests\UpdateCalonRequest;
use App\Models\Calon;
use App\Models\Paslon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CalonController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('calon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calons = Calon::with(['paslon', 'media'])->get();

        return view('admin.calons.index', compact('calons'));
    }

    public function create()
    {
        abort_if(Gate::denies('calon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paslons = Paslon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.calons.create', compact('paslons'));
    }

    public function store(StoreCalonRequest $request)
    {
        $calon = Calon::create($request->all());

        if ($request->input('image', false)) {
            $calon->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $calon->id]);
        }

        return redirect()->route('admin.calons.index');
    }

    public function edit(Calon $calon)
    {
        abort_if(Gate::denies('calon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paslons = Paslon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $calon->load('paslon');

        return view('admin.calons.edit', compact('paslons', 'calon'));
    }

    public function update(UpdateCalonRequest $request, Calon $calon)
    {
        $calon->update($request->all());

        if ($request->input('image', false)) {
            if (!$calon->image || $request->input('image') !== $calon->image->file_name) {
                if ($calon->image) {
                    $calon->image->delete();
                }
                $calon->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($calon->image) {
            $calon->image->delete();
        }

        return redirect()->route('admin.calons.index');
    }

    public function show(Calon $calon)
    {
        abort_if(Gate::denies('calon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calon->load('paslon');

        return view('admin.calons.show', compact('calon'));
    }

    public function destroy(Calon $calon)
    {
        abort_if(Gate::denies('calon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calon->delete();

        return back();
    }

    public function massDestroy(MassDestroyCalonRequest $request)
    {
        Calon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('calon_create') && Gate::denies('calon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Calon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
