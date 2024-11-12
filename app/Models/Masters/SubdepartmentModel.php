<?php

namespace App\Models\Masters;

use CodeIgniter\Model;

class SubdepartmentModel extends Model
{
    protected $table = 'sub_departments'; // Set the table name
    protected $primaryKey = 'id'; // Set the primary key

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['department_id','name', 'created_at', 'updated_at']; // Fields that can be dynamically updated

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Fetch all Subdepartments
    public function getAllSubdepartments()
    {
        return $this->findAll();
    }

    // In your SubdepartmentModel (or similar name)
  public function getSubdepartmentsWithDepartments() {
    $this->select('sub_departments.id, sub_departments.name, sub_departments.created_at, sub_departments.updated_at, departments.name as department_name');
    $this->join('departments', 'departments.id = sub_departments.department_id', 'left');
    $this->orderBy('sub_departments.id', 'ASC');
    return $this->findAll(); 
}

}
