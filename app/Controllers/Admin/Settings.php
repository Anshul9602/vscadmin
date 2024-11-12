<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\City;
use App\Models\ApiUserModel;
use App\Models\LocationModel;
use App\Models\DegreeModel;
use App\Models\CollegeModel;
use App\Models\SchoolModel;


class Settings extends BaseController
{
    protected $adminModel;
    protected $apiUserModel;
    protected $locationModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->apiUserModel = new ApiUserModel();
        $this->locationModel = new LocationModel();
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

    // Admin methods
    public function listAdmins($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'admins' => $this->adminModel->findAll(),
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_admins', $data);
    }

    public function storeAdmin()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->adminModel->insert($data)) {
            return $this->jsonResponse('success', 'Admin added successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to add admin');
        }
    }

    public function editAdmin($id = null)
    {
        $admin = $this->adminModel->find($id);
        if ($admin) {
            return $this->response->setJSON($admin);
        } else {
            return $this->jsonResponse('error', 'Admin not found');
        }
    }

    public function updateAdmin($id = null)
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->adminModel->update($id, $data)) {
            return $this->jsonResponse('success', 'Admin updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update admin');
        }
    }

    public function deleteAdmin($id = null)
    {
        if ($this->adminModel->delete($id)) {
            return $this->jsonResponse('success', 'Admin deleted successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to delete admin');
        }
    }

    // API Users Management
    public function listApiUsers($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'api_users' => $this->apiUserModel->findAll(),
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_api_users', $data);
    }

    public function storeApiUser()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'token' => bin2hex(random_bytes(32)),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->apiUserModel->insert($data)) {
            return $this->jsonResponse('success', 'API User added successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to add API User');
        }
    }

    public function editApiUser($id = null)
    {
        $apiUser = $this->apiUserModel->find($id);
        if ($apiUser) {
            return $this->response->setJSON($apiUser);
        } else {
            return $this->jsonResponse('error', 'API User not found');
        }
    }

    public function updateApiUser($id = null)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->apiUserModel->update($id, $data)) {
            return $this->jsonResponse('success', 'API User updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update API User');
        }
    }

    public function deleteApiUser($id = null)
    {
        if ($this->apiUserModel->delete($id)) {
            return $this->jsonResponse('success', 'API User deleted successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to delete API User');
        }
    }

    // Data Masters Settings
    public function listDataMaster($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_data_masters', $data);
    }

    private function setModelConfig($type): LocationModel
    {
        $this->locationModel->setTableConfig($type);
        return $this->locationModel;
    }

    // Cities Management
    public function listAllCities($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }
        $model = new City();
        $cities = $model->getallcity();
       

      

        $data = [
            'cities' => $cities,
            
            'token' => $token,
            'role' => session()->get('role')
        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        return view('admin/settings/list_all_cities', $data);
    }

    public function storeCity()
    {
        $locationModel = $this->setModelConfig('cities');
        $data = [
            'city_name' => $this->request->getPost('city_name'),
            'state_code' => $this->request->getPost('state_code')
        ];

        if ($locationModel->insert($data)) {
            return $this->jsonResponse('success', 'City added successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to add city');
        }
    }

    public function editCity($id = null)
    {
        $city = $this->setModelConfig('cities')->find($id);
        if ($city) {
            return $this->response->setJSON($city);
        } else {
            return $this->jsonResponse('error', 'City not found');
        }
    }

    public function updateCity($id = null)
    {
        $data = [
            'city_name' => $this->request->getPost('city_name'),
            'state_name' => $this->request->getPost('state_code')
        ];
        $model = new City();
        $post = $model-> updatecity($id, $data);
        if ($post !== null) {
            return $this->jsonResponse('success', 'City updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update city');
        }
    }

    public function deleteCity($id = null)
    {
        if ($this->setModelConfig('cities')->delete($id)) {
            return $this->jsonResponse('success', 'City deleted successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to delete city');
        }
    }

    // States Management
    public function listAllStates($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'states' => $this->setModelConfig('states')->findAll(),
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_all_states', $data);
    }

    public function storeState()
    {
        $data = [
            'state_name' => $this->request->getPost('state_name'),
            
           
        ];
        $model = new City();
        $post = $model-> savestate($data);
        if ($this->setModelConfig('states')->insert($data)) {
            return $this->jsonResponse('success', 'State added successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to add state');
        }
    }

    public function editState($id = null)
    {



        $state = $this->setModelConfig('states')->find($id);
        if ($state) {
            return $this->response->setJSON($state);
        } else {
            return $this->jsonResponse('error', 'State not found');
        }
    }

    public function updateState($id = null)
    {
        $data = [
            'state_name' => $this->request->getPost('state_name'),
           
        ];
 $model = new City();
        $post = $model-> updatestate($id, $data);
        if ($post !== null) {
            return $this->jsonResponse('success', 'State updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update state');
        }
    }

    public function deleteState($id = null)
    {
        if ($this->setModelConfig('states')->delete($id)) {
            return $this->jsonResponse('success', 'State deleted successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to delete state');
        }
    }

    // Pincodes Management
    public function listAllPincodes($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }
        $model = new City();
        $cities = $model->getallcity();
        $data = [
         
            'states' => $cities,
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_all_pincodes', $data);
    }
    public function listAllRewords($token = null)
    {
        if (!$this->validateToken($token)) {
            return redirect()->to('/admin/login');
        }
        $model = new City();
        $cities = $model->getallreword();
        $data = [
         
            'reword' => $cities,
            'token' => $token,
            'role' => session()->get('role')
        ];

        return view('admin/settings/list_reword', $data);
    }

    public function storePincode()
    {
        $data = [
            'pincode' => $this->request->getPost('pincode')
            
        ];

        $model = new City();
        $post = $model-> savepincode( $data);
        if ($post !== null) {
            return $this->jsonResponse('success', 'Pincode added successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to add pincode');
        }
    }

    public function editPincode($id = null)
    {
        $pincode = $this->setModelConfig('pincodes')->find($id);
        if ($pincode) {
            return $this->response->setJSON($pincode);
        } else {
            return $this->jsonResponse('error', 'Pincode not found');
        }
    }
    public function editRewords($id = null)
    {
        $rewords = $this->setModelConfig('rewords')->find($id);
        if ($rewords) {
            return $this->response->setJSON($rewords);
        } else {
            return $this->jsonResponse('error', 'Points not found');
        }
    }

    public function updateRewords($id = null)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'points' => $this->request->getPost('points')
            
        ];

        $model = new City();
        $post = $model-> updaterewords($id, $data);
        if ($post !== null) {
            return $this->jsonResponse('success', 'Pincode updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update pincode');
        }
    }
    public function updatePincode($id = null)
    {
        $data = [
            'pincode' => $this->request->getPost('pincode')
            
        ];

        $model = new City();
        $post = $model-> updatepincode($id, $data);
        if ($post !== null) {
            return $this->jsonResponse('success', 'Pincode updated successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to update pincode');
        }
    }

    public function deletePincode($id = null)
    {
        if ($this->setModelConfig('pincodes')->delete($id)) {
            return $this->jsonResponse('success', 'Pincode deleted successfully');
        } else {
            return $this->jsonResponse('error', 'Failed to delete pincode');
        }
    }
}
