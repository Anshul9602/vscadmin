<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class EventsModel extends Model
{
    protected $table = 'user_events';

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
   
    public function getEventsData($userId)
    {

        $builder = $this->db->table('user_events');
        $builder->select('user_events.*');

        $builder->where('user_events.id', $userId);
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
        $builder = $this->db->table('user_events');
        $builder->select('user_events.*');
      
      
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


  
   
    public function EventsCount()
    {
        $builder = $this->db->table('user_events');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }


    
    public function findEventsByName(string $name)
    {
        // echo "test";
        // die();
        $user = $this
            ->asArray()
            ->where(['name' => $name])
            ->last();

        if (!$user) {
            return 0;
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
    public function findEventsById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('Event does not exist for specified id');

        return $user;
    }
   



    public function save_events($data)
    {
        $name = $data['first_name'];
      
        $meta_title = $data['meta_title'];
        $meta_des = $data['meta_des'];
        $meta_tag = $data['meta_tag'];
        $content = $data['content'];
        $date = $data['date'];
        $time = $data['time'];
        $status = "Enable";
        // $date = new DateTime();
        // $date = date_default_timezone_set('Asia/Kolkata');
        // $date1 = date("m-d-Y h:i A");

        $sql = "INSERT INTO `user_events`(`name`,`meta_title`,`meta_des`,`meta_tag`,`content`,`time`, `status`, `created_at`) VALUES ('$name','$meta_title','$meta_des','$meta_tag','$content','$time','$status','$date')";
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            
            return $post;
        }
    }

    public function findEventsId(string $name)
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

    public function update_events($id, $data)
    {
        //    echo json_encode($sql);

        $name = $data['first_name'];
        $time = $data['time'];
        $meta_title = $data['meta_title'];
        $meta_des = $data['meta_des'];
        $meta_tag = $data['meta_tag'];
        $content = $data['content'];
        $date = $data['date'];

        // $date = new DateTime();
        // $date = date_default_timezone_set('Asia/Kolkata');
        // $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `user_events` SET time = '$time',       meta_title = '$meta_title',
        meta_des = '$meta_des',name='$name',meta_tag='$meta_tag',content='$content',created_at ='$date'
        WHERE id = $id";
    
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



        $result = $this->findEventsById($id);

        // print_r($result);

        if ($result) {
            $current_status = $result['status'];

            // Toggle the status
            $new_status = ($current_status === 'Enable') ? 'Disable' : 'Enable';

            // Update the status in the database
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date1 = date("m-d-Y h:i A");

            $sql = "UPDATE `user_events` SET `status`='$new_status' WHERE `id` = $id";
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
        $sql = "DELETE FROM `user_events` WHERE id = ?";

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
