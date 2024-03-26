<?php

namespace App\Admin\DataTables\Employee;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use App\Admin\Traits\GetConfig;

class EmployeeDataTable extends BaseDataTable
{
    use GetConfig;
    protected $nameTalbe = 'employeeTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    public function getView(){
        return [
            'action' => 'admin.employees.datatable.action',
            'editlink' => 'admin.employees.datatable.editlink',
        ];
    }

    public function dataTable($query)
    {
        $this->instanceDataTable = datatables()->eloquent($query)->addIndexColumn();
        $this->filterColumnGender();
        $this->filterColumnRole();
        $this->editColumnEmail();
        $this->editColumnId();
        $this->editColumnGender();
        $this->editColumnRole();
        $this->addColumnAction();
        $this->rawColumnsNew();
        
        return $this->instanceDataTable;
    }

    public function query(\App\Models\Employee $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        $this->instanceHtml = $this->builder()
        ->setTableId('employeeTable')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->orderBy(0)
        ->selectStyleSingle();

        $this->htmlParameters();

        return $this->instanceHtml;
    }

    protected function filterColumnGender(){
        $this->instanceDataTable = $this->instanceDataTable
        ->filterColumn('gender', function($query, $keyword) {
            $query->where('gender', $keyword);
        });
    }
    protected function filterColumnRole(){
        $this->instanceDataTable = $this->instanceDataTable
        ->filterColumn('role', function($query, $keyword) {
            $query->where('role', $keyword);
        });
    }

    protected function editColumnGender(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('gender', function($admin){
            return $admin->gender->description();
        });
    }

    protected function editColumnRole(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('role', function($admin){
            return $admin->role->description();
        });
    }


    protected function editColumnId(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('id', $this->view['editlink']);
    }

    protected function editColumnEmail(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('email', $this->view['editlink']);
    }

    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['email', 'action']);
    }

    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#employeeTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }

    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('employee');
    }
    
}
