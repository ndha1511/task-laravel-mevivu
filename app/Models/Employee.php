<?php
    namespace App\Models;

use App\Enums\Employee\EmployeeGender;
use App\Enums\Employee\EmployeeRoles;
use Illuminate\Database\Eloquent\Model;

    class Employee extends Model {
        public $timestamps = false;
        protected $fillable = [
            'username',
            'email',
            'password',
            'role',
            'gender',
            'date'
        ];

        protected $casts = [
            'gender' => EmployeeGender::class,
            'role' => EmployeeRoles::class,
            'date'=> 'date'
        ];
    }
?>