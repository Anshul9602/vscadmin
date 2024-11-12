<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class CandidatesModel extends Model
{
    protected $table = 'user_blog';

    protected $allowedFields = [
        'mobile_number',

    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {

        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }






    /// get user information
    public function getUserData($userId)
    {

        $builder = $this->db->table('user_profiles');
        $builder->select('user_profiles.*');

        $builder->where('user_profiles.user_id', $userId);
        $query = $builder->get();

        $user = $query->getResult();


        if (!$user) {
            return null;
        } else {
            return $user[0];
        }
    }
    public function getBlogData($userId)
    {

        $builder = $this->db->table('user_blog');
        $builder->select('user_blog.*');

        $builder->where('user_blog.id', $userId);
        $query = $builder->get();

        $user = $query->getResult();


        if (!$user) {
            return null;
        } else {
            return $user[0];
        }
    }

    public function getAllUserData()
    {
        $builder = $this->db->table('user_blog');
        $builder->select('user_blog.*');
      
      
        $query = $builder->get();
        $user = $query->getResult();
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // die();
        if (empty($user)) {
            // echo "test";
            return false;
        } else {
            return $user;
        }
    }


    public function getUserCount()
    {
        $builder = $this->db->table('users');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function UserCount()
    {
        $builder = $this->db->table('user_profiles');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function BlogCount()
    {
        $builder = $this->db->table('user_blog');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }


    public function findUserByUserNumber1(string $mobile_number)
    {
        // echo "test";
        // die();
        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return 0;
        } else {
            return $user;
        }
    }

    public function findUserByUserNumber(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function findUserByUserName(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }


    public function findAll(int $limit = 0, int $offset = 0)
    {
        if ($this->tempAllowCallbacks) {
            // Call the before event and check for a return
            $eventData = $this->trigger('beforeFind', [
                'method'    => 'findAll',
                'limit'     => $limit,
                'offset'    => $offset,
                'singleton' => false,
            ]);

            if (!empty($eventData['returnData'])) {
                return $eventData['data'];
            }
        }

        $eventData = [
            'data'      => $this->doFindAll($limit, $offset),
            'limit'     => $limit,
            'offset'    => $offset,
            'method'    => 'findAll',
            'singleton' => false,
        ];

        if ($this->tempAllowCallbacks) {
            $eventData = $this->trigger('afterFind', $eventData);
        }

        $this->tempReturnType     = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;
        $this->tempAllowCallbacks = $this->allowCallbacks;

        return $eventData['data'];
    }
    public function findBlogById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified user id');

        return $user;
    }
    public function findUserById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified user id');

        return $user;
    }




    public function save_blog($data)
    {


        $name = $data['name'];
        $author = $data['author'];
        $meta_title = $data['meta_title'];
        $meta_des = $data['meta_des'];
        $meta_tag = $data['meta_tag'];
        $content = $data['content'];
        $status = "Enable";
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");


        $sql = "INSERT INTO `user_blog`(`name`,`author`,`meta_title`,`meta_des`,`meta_tag`,`content`, `status`, `created_at`) VALUES ('$name','$author','$meta_title','$meta_des','$meta_tag','$content','$status','$date1')";


        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            
            return $post;
        }
    }

    public function findBlogId(string $name)
    {

        $user = $this
            ->asArray()
            ->where(['name' => $name])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }

    public function update_blog($id, $data)
    {
        //    echo json_encode($sql);

        $name = $data['name'];
        $author = $data['author'];
        $meta_title = $data['meta_title'];
        $meta_des = $data['meta_des'];
        $meta_tag = $data['meta_tag'];
        $content = $data['content'];

        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `user_blog` SET 
        author` = '$author',       `meta_title` = '$meta_title',
        `meta_des` = '$meta_des',
        `name`='$name',`meta_tag`='$meta_tag',`content`='$content' WHERE id = $id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
    public function update_status_e($id)
    {
        //    echo json_encode($sql);
        $id = $id;

        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `user_blog` SET `status`='Enable',`created_at`='$date1' WHERE id = $id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }

    public function update_status_d($id)
    {



        $result = $this->findBlogById($id);

        // print_r($result);

        if ($result) {
            $current_status = $result['status'];

            // Toggle the status
            $new_status = ($current_status === 'Enable') ? 'Disable' : 'Enable';

            // Update the status in the database
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date1 = date("m-d-Y h:i A");

            $sql = "UPDATE `user_blog` SET `status`='$new_status',`created_at`='$date1' WHERE `id` = $id";
            $post = $this->db->query($sql);

            if (!$post) {
                return false;
            } else {
                return $post;
            }
        } else {
            return false; // User not found
        }
    }




    // user delete

    public function delete_usweb($id)
    {
        // Prepare the SQL statement with a placeholder for the id
        $sql = "DELETE FROM `user_blog` WHERE id = ?";

        // Execute the prepared statement with the id parameter
        $post = $this->db->query($sql, [$id]);

        // Check if the query was executed successfully
        if (!$post) {
            // If the query fails, return false
            return false;
        } else {
            // If the query succeeds, return true
            return true;
        }
    }
}
