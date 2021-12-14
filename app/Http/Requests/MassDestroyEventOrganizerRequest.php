<?php

namespace App\Http\Requests;

use App\Models\EventOrganizer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEventOrganizerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('event_organizer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:event_organizers,id',
        ];
    }
}
