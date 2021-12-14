<?php

namespace App\Http\Requests;

use App\Models\Post;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_create');
    }

    public function rules()
    {
        return [
            'post_title' => [
                'string',
                'min:4',
                'max:50',
                'required',
            ],
            'post_header' => [
                'string',
                'min:10',
                'max:300',
                'required',
            ],
            'post_status' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
