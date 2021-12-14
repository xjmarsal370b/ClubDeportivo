<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'event_name' => [
                'string',
                'min:3',
                'max:30',
                'required',
            ],
            'date_event' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'desc_event' => [
                'string',
                'min:4',
                'max:250',
                'required',
            ],
            'transportation_id' => [
                'required',
                'integer',
            ],
            'organizer_id' => [
                'required',
                'integer',
            ],
            'members.*' => [
                'integer',
            ],
            'members' => [
                'required',
                'array',
            ],
        ];
    }
}
