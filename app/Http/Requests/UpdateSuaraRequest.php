<?php

namespace App\Http\Requests;

use App\Models\Suara;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSuaraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suara_edit');
    }

    public function rules()
    {
        return [];
    }
}
