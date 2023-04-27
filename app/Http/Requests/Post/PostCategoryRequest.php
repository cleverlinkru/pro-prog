<?php

namespace App\Http\Requests\Post;

use App\Models\Post\PostCategory;
use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $postCategoryTable = with(new PostCategory)->getTable();
        return [
            'title' => ['required', 'string'],
            'category_id' => ['nullable', 'integer', "exists:$postCategoryTable,id"],
        ];
    }
}
