<?php

namespace App\Http\Requests;

use App\Models\Calon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCalonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('calon_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'visi' => [
                'string',
                'nullable',
            ],
            'misi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
