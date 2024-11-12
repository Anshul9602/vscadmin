<?php

namespace App\Models\Masters;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments'; // Set the table name
    protected $primaryKey = 'id'; // Set the primary key

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'created_at', 'updated_at']; // Fields that can be dynamically updated

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Fetch all departments
    public function getAllDepartments()
    {
        return $this->findAll();
    }
}
