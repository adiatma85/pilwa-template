<?php

namespace App\Http\Requests;

use App\Models\Paslon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaslonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('paslon_create');
    }

    public function rules()
    {
        return [
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
