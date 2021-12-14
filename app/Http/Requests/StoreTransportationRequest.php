<?php

namespace App\Http\Requests;

use App\Models\Transportation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransportationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transportation_create');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'min:2',
                'max:30',
                'required',
            ],
            'transportation_type' => [
                'required',
            ],
            'dep_place' => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'dep_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
