<?php

namespace App\Admin\Services\Employee;

use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeService implements EmployeeServiceInterface
{
    protected $data;
    protected $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        $this->data = $request->all();
        $this->data['password'] = bcrypt($this->data['password']);

        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->all();

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }
        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }
}
