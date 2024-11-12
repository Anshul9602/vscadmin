<?php

namespace App\Models;

use CodeIgniter\Model;

class City extends Model
{
    protected $table            = 'unified_pincodes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'pass', 'role'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function getallcity()
    {

        $builder = $this->db->table('unified_pincodes');
        $builder->select('*');


        $query = $builder->get();
        // Get the result
        $user = $query->getResult();

        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // die();
        // Check if user data is found
        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function getallreword()
    {

        $builder = $this->db->table('reword');
        $builder->select('*');

        $query = $builder->get();
        // Get the result
        $user = $query->getResult();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function updatecity($id, $Data)
    {

        $city = $Data['city_name'];
        $state_name = $Data['state_name'];

        $sql = "UPDATE `unified_pincodes` SET  
        
        `city_name` = '$city',
        `state_name` = '$state_name'
        
          WHERE id = $id";

        $post = $this->db->query($sql);

        if (!$post) {
            return null;
        } else {
            return $post;
        }
    }
    public function updatestate($id, $Data)
    {

       
        $state_name = $Data['state_name'];

        $sql = "UPDATE `unified_pincodes` SET  
        
      
        `state_name` = '$state_name'
        
          WHERE id = $id";

        $post = $this->db->query($sql);

        if (!$post) {
            return null;
        } else {
            return $post;
        }
    }
    public function updaterewords($id, $Data)
    {

        $name = $Data['name'];
        $points = $Data['points'];
        

        $sql = "UPDATE `reword` SET  
        
        `name` = '$name',
        `points` = '$points'
        
          WHERE id = $id";

        $post = $this->db->query($sql);

        if (!$post) {
            return null;
        } else {
            return $post;
        }
    }
    public function updatepincode($id, $Data)
    {

        $pincode = $Data['pincode'];
        

        $sql = "UPDATE `unified_pincodes` SET  
        
        `pincode` = '$pincode'
        
          WHERE id = $id";

        $post = $this->db->query($sql);

        if (!$post) {
            return null;
        } else {
            return $post;
        }
    }
}
