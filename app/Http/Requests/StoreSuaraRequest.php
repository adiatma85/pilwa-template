<?php

namespace App\Http\Requests;

use App\Models\Suara;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuaraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suara_create');
    }

    public function rules()
    {
        return [];
    }
}
