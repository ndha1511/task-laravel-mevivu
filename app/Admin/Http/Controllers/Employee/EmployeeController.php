<?php

namespace App\Admin\Http\Controllers\Employee;

use App\Admin\DataTables\Employee\EmployeeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Employee\EmployeeRequest;
use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use App\Admin\Services\Employee\EmployeeServiceInterface;
use App\Enums\Employee\EmployeeGender;
use App\Enums\Employee\EmployeeRoles;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    
    public function __construct(
        EmployeeServiceInterface $service,
        EmployeeRepositoryInterface $repository
    ) {
        parent::__construct();
        $this->service = $service;
        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.employees.index',
            'create' => 'admin.employees.create',
            'edit' => 'admin.employees.edit'
        ];
    }
    public function getRoute()
    {
        return [
            'index' => 'admin.employee.index',
            'create' => 'admin.employee.create',
            'edit' => 'admin.employee.edit',
            'delete' => 'admin.employee.delete'
        ];
    }

    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'role' => EmployeeRoles::asSelectArray(),
            'gender' => EmployeeGender::asSelectArray()
        ]);
    }

    public function create(){
        return view($this->view['create'], [
            'role' => EmployeeRoles::asSelectArray(),
            'gender' => EmployeeGender::asSelectArray()
        ]);
    }

    public function store(EmployeeRequest $request){

        $instance = $this->service->store($request);

        return redirect()->route($this->route['edit'], $instance->id);

    }

    public function edit($id){
        
        $instance = $this->repository->findOrFail($id);
        $date = Carbon::parse($instance->date)->format('Y-m-d');
        return view(
            $this->view['edit'], 
            [
                'employee' => $instance, 
                'role' => EmployeeRoles::asSelectArray(),
                'gender' => EmployeeGender::asSelectArray(),
                'date' => $date
            ], 
        );

    }

    public function update(EmployeeRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return redirect()->route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}
