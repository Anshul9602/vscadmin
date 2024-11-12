<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\Masters\SubdepartmentModel;
use App\Models\Masters\DepartmentModel;

class Subdepartments extends BaseController
{
    protected $SubdepartmentModel;

    public function __construct()
    {
        $this->SubdepartmentModel = new SubdepartmentModel();
        $this->DepartmentModel = new DepartmentModel();
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

    // Display all Subdepartments
    public function listAllSubdepartments($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'token' => $segment,
            'role' => session()->get('role')
        ];
        $data['subdepartments'] = $this->SubdepartmentModel->getSubdepartmentsWithDepartments();
        $data['departments'] = $this->DepartmentModel->findAll();
        return view('admin/settings/masters/list_subdepartments', $data);
    }

    // Store a new Subdepartment
    public function storeSubdepartment()
    {
        $data = [
            'department_id' => $this->request->getPost('department_id'),
            'name' => $this->request->getPost('name'),
            'created_at' => date('Y-m-d H:i:s'), // Auto set current time
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->SubdepartmentModel->save($data);
        return redirect()->to(base_url('admin/settings/listAllSubDepartments/'.session()->get('token')));
    }

    // Display the edit form for a Subdepartment
    public function editSubdepartment($id)
    {
        $data['Subdepartment'] = $this->SubdepartmentModel->find($id);
        return $this->response->setJSON($data);
    }

    // Update a Subdepartment
    public function updateSubdepartment($id)
    {
        $data = [
            'department_id'=>$this->request->getPost('department_id'),
            'name' => $this->request->getPost('name'),
            'updated_at' => date('Y-m-d H:i:s') // Auto update current time
        ];

        $this->SubdepartmentModel->update($id, $data);
        return redirect()->to(base_url('admin/settings/listAllSubDepartments/'.session()->get('token')));
    }

    // Delete a Subdepartment
    public function deleteSubdepartment($id)
    {
        $this->SubdepartmentModel->delete($id);
        return redirect()->to(base_url('admin/settings/listAllSubDepartments/'.session()->get('token')));
    }
}
