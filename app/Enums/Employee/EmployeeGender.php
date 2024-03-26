<?php

namespace App\Enums\Employee;

use App\Support\Enum;

enum EmployeeGender: int
{   
    use Enum;

    case Male = 1;
    case Female = 2;
    case Other = 3;
}