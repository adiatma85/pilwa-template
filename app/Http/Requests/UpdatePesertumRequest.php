<?php

namespace App\Http\Requests;

use App\Models\Pesertum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePesertumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pesertum_edit');
    }

    public function rules()
    {
        return [
            'nim' => [
                'string',
                'nullable',
            ],
        ];
    }
}
