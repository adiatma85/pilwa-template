<?php

namespace App\Http\Requests;

use App\Models\Suara;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySuaraRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('suara_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:suaras,id',
        ];
    }
}
