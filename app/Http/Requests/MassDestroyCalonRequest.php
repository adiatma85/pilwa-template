<?php

namespace App\Http\Requests;

use App\Models\Calon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCalonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('calon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:calons,id',
        ];
    }
}
