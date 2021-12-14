<?php

namespace App\Http\Requests;

use App\Models\EventOrganizer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventOrganizerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_organizer_edit');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'min:2',
                'max:30',
                'required',
            ],
        ];
    }
}
