<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class JobApplyModel extends Model
{
    protected $table = 'job_applications';

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

    public function getJobData($jobId)
{
    $builder = $this->db->table('job_applications');

    // Select the fields explicitly from the joined tables to avoid ambiguity
    $builder->select('user_profiles.*, users.work_ex,users.mobile_number, users.id AS user_id, job_applications.*');

    // Join the user_profiles table
    $builder->join('user_profiles', 'user_profiles.user_id = job_applications.user_id');

    // Left join with the users table
    $builder->join('users', 'users.id = job_applications.user_id', 'left');

    // Filter by job_applications.job_id
    $builder->where('job_applications.job_id', $jobId);

    // Execute the query
    $query = $builder->get();

    // Check for query success
    if ($this->db->error()['code'] != 0) {
        // Log or handle error as needed
        return null;
    }

    // Get the result
    $result = $query->getResult();

    return $result ? $result : null;
}
   
    /// get user information
    public function getJobCount($jobId)
{
    $builder = $this->db->table('job_applications');
    $builder->select('COUNT(*) as user_count');

    // Add a where clause to filter by job_id
    $builder->where('job_id', $jobId);

    $query = $builder->get();
    $result = $query->getRow();

    return $result->user_count;
}
    public function findJobByjobId(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['job_id' => $id])
            ->findAll();

        if (!$user) {
            throw new Exception('Job apply does not found');
        } else {
            return $user;
        }
    }
    public function findJobById(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user) {
            throw new Exception('Job does not found');
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



    public function saved($data): bool
    {

        $job_id = $data['job_id'];
        $user_id = $data['user_id'];
        $resume_id = $data['resume_id'];
        $status = 'In Touch';


        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `job_applications`( `job_id`, `user_id`, `resume_id`,`status`, `created_at`, `updated_at`) VALUES ('$job_id','$user_id','$resume_id','$status','$date1','$date1')";



        //     echo "<pre>"; print_r($sql); echo "</pre>";
        // die();

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post) {
            return null;
        } else {
            return $post;
        }
    }


    //Update
    public function update1($id, $data): bool
    {
        // echo $id;


        $status = $data['status'];
        $sql = "UPDATE `job_applications` SET  
        status = '$status'
          WHERE id = $id";
        // print_r($sql);
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['id' => $id])
            ->delete();

        if (!$post)
            throw new Exception('user does not exist for specified id');

        return $post;
    }
}

