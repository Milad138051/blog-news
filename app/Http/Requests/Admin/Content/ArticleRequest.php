<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|max:120|min:2',
                'body' => 'required|max:500|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'category_id' => 'required|min:1|max:100000000|exists:article_categories,id',
                'status' => 'required|numeric|in:0,1',
                'commentable' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'title' => 'required|max:120|min:2',
                'body' => 'required|max:500|min:5',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'commentable' => 'required|numeric|in:0,1',
                'category_id' => 'required|min:1|max:100000000|exists:article_categories,id',

            ];
        }
    }
}
