<?php

namespace App\Admin\Http\Requests\Post;

use App\Admin\Http\Requests\BaseRequest;

use Illuminate\Validation\Rule;

class PostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // 'username' => [
            //     'required', 
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username', 
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'is_featured' => ['required', 'boolean'],
            'status' => ['required', 'string'],
            'image' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            'username' => [
                'required', 
                'string', 'min:6', 'max:50',
                'unique:App\Models\User,username,'.$this->id, 
                'regex:/^[A-Za-z0-9_-]+$/',
                function ($attribute, $value, $fail) {
                    if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
                        $fail('The '.$attribute.' cannot be a common keyword.');
                    }
                },
            ],
           
        ];
    }
}