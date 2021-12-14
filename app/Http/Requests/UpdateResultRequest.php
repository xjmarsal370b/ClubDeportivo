<?php

namespace App\Http\Requests;

use App\Models\Result;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateResultRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('result_edit');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'member_id' => [
                'required',
                'integer',
            ],
            'score' => [
                'string',
                'min:1',
                'max:20',
                'required',
            ],
        ];
    }
}
