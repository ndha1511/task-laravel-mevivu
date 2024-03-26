<?php

namespace App\Admin\Http\Requests\Employee;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Employee\EmployeeGender;
use App\Enums\Employee\EmployeeRoles;
use Illuminate\Validation\Rules\Enum;

class EmployeeRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'username' => [
                'required',
                'string',
                'min:6',
                'max:50',
                'unique:App\Models\Employee,username',
                'regex:/^[A-Za-z0-9_-]+$/'
            ],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email'],
            'gender' => ['required', new Enum(EmployeeGender::class)],
            'role' => ['required', new Enum(EmployeeRoles::class)],
            'password' => ['required', 'string', 'confirmed'],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Employee,id'],
            'username' => [
                'required',
                'string', 'min:6', 'max:50',
                'regex:/^[A-Za-z0-9_-]+$/'
            ],
            'password' => ['nullable', 'string', 'confirmed'],
            'email' => ['required', 'email'],
            'gender' => ['required', new Enum(EmployeeGender::class)],
            'role' => ['required', new Enum(EmployeeRoles::class)],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }
}
