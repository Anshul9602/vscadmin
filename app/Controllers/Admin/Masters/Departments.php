<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\Masters\DepartmentModel;

class Departments extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    private function validateToken($token)
    {
        if ($token !== session()->get('token')) {
            return false;
        }
        return true;
    }

    private function jsonResponse($status, $message)
    {
        return $this->response->setJSON(['status' => $status, 'message' => $message]);
    }

    // Display all departments
    public function listAllDepartments($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'token' => $segment,
            'role' => session()->get('role')
        ];
        $data['departments'] = $this->departmentModel->getAllDepartments();
        return view('admin/settings/masters/list_departments', $data);
    }

    // Store a new department
    public function storeDepartment()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'created_at' => date('Y-m-d H:i:s'), // Auto set current time
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->departmentModel->save($data);
        return redirect()->to(base_url('admin/settings/listAllDepartments/'.session()->get('token')));
    }

    // Display the edit form for a department
    public function editDepartment($id)
    {
        $data['department'] = $this->departmentModel->find($id);
        return $this->response->setJSON($data);
    }

    // Update a department
    public function updateDepartment($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'updated_at' => date('Y-m-d H:i:s') // Auto update current time
        ];

        $this->departmentModel->update($id, $data);
        return redirect()->to(base_url('admin/settings/listAllDepartments/'.session()->get('token')));
    }

    // Delete a department
    public function deleteDepartment($id)
    {
        $this->departmentModel->delete($id);
        return redirect()->to(base_url('admin/settings/listAllDepartments/'.session()->get('token')));
    }
}
