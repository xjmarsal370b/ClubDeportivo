<?php

namespace App\Http\Requests;

use App\Models\PostCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_category_create');
    }

    public function rules()
    {
        return [
            'cat_name' => [
                'string',
                'min:4',
                'max:20',
                'required',
                'unique:post_categories',
            ],
        ];
    }
}
