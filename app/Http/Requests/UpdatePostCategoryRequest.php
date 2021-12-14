<?php

namespace App\Http\Requests;

use App\Models\PostCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_category_edit');
    }

    public function rules()
    {
        return [
            'cat_name' => [
                'string',
                'min:4',
                'max:20',
                'required',
                'unique:post_categories,cat_name,' . request()->route('post_category')->id,
            ],
        ];
    }
}
