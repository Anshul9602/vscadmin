<?php

namespace App\Controllers\Admin\Candidates;

use App\Controllers\profile_img;
use App\Models\ProfileModel;
use App\Controllers\BaseController;
use App\Models\CandidatesModel;
use App\Models\Job_prefModel;
use App\Models\JobApplyModel;
use App\Models\ResumeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Candidates extends BaseController
{
    protected $candidatesModel;

    public function __construct()
    {
        $this->candidatesModel = new CandidatesModel();
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

    // Display all candidates
    public function listAllCandidates($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'users' => [] // Initialize 'users' to an empty array
        ];

        $model = new CandidatesModel();
        $users = $model->getAllUserData();

        $profile = new ProfileModel();
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

        if ($users) {
            foreach ($users as $user) {



                $user_id = $user->id;
                $post1 = $profile->findByUId($user_id);

                if ($post1 !== null) {
                    $resume1 = $post1['image_path'];
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory

                    // Debugging
                    // echo "Checking path: " . $existingFilePath . "<br>";
                    // echo "File exists: " . (file_exists($existingFilePath) ? 'Yes' : 'No') . "<br>";

                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl . '/' . $resume1;
                    } else {
                        $user_img = $baseUrl . '/images/user_img.png';
                    }
                } else {
                    $user_img = $baseUrl . '/images/user_img.png';
                }


                // Add user image to user object
                $user->image_url = $user_img;
                $data['users'][] = $user;
            }
        }
        //  echo "<pre>";

        //                 print_r($data);
        //                 echo "</pre>";
        //                 die();
        // If no users are found, 'users' will be an empty array
        // No need to add null values

        // Debugging


        return view('admin/candidates/list_candidates', $data);
    }

    public function listCandidate_delete($id)
    {

        // echo "yes";
        $model = new CandidatesModel();

        $post = $model->delete_usweb($id);

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCandidate_status($id)
    {

        // echo "yes";
        $model = new CandidatesModel();

        $post = $model->update_status_d($id);

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCandidate_save()
    {

        $data = $this->request->getPost();
        $rofile_pic = $this->request->getFile('profile_pic');
        $resume = $this->request->getFile('resume');
        $input = [
            'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
            'name' => isset($data['first_name']) ? $data['first_name'] : '',
            'author' => isset($data['author']) ? $data['author'] : '',
            'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : '',

            'meta_des' => isset($data['meta_des']) ? $data['meta_des'] : '',
            'date' => isset($data['date']) ? $data['date'] : '',
            'meta_tag' => isset($data['meta_tag']) ? $data['meta_tag'] : '',
            'content' => isset($data['content']) ? $data['content'] : '',

            'profile_img' => isset($rofile_pic) ? $rofile_pic : ''

        ];


        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();

        $model = new CandidatesModel();
        if ($input['user_id'] !== '') {
            $user1 = $model->update_blog($input['user_id'], $data);
        } else {
            $user1 = $model->save_blog($data);
        }

        $userd = $model->findBlogId($input['name']);


        if ($input['profile_img'] !== '') {
            $prof_img =  $this->store_prof_img($userd['id'], $input);

            if ($prof_img == true) {
            } else {
                return "Error: profile image not inserted successfully";
            }
        }



        return $this->response->setStatusCode(200)->setBody('user saved');
    }
    public function listCandidate_getByid($id)
    {
        $user = new CandidatesModel();
        $posts = $user->findBlogById($id); // Find all job applications by job ID

        if ($posts) {
            $data = []; // Initialize an array to hold all user data



            $baseUrl = base_url(); // Assuming you have configured the base URL in your CodeIgniter configuration
            $baseUrl = str_replace('/public/', '/', $baseUrl);
            $user_id = $id;
            $user = new CandidatesModel();
            $udata = $user->getBlogData($user_id);
            $profile = new ProfileModel();
            $baseUrl1 = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash
            $post1 = $profile->findByUId($user_id);

            if ($post1 !== null) {
                $resume1 = $post1['image_path'];
                $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory
                if (file_exists($existingFilePath)) {
                    $user_img = $baseUrl1 . '/' . $resume1;
                } else {
                    $user_img = $baseUrl1 . '/images/user_img.png';
                }
            } else {
                $user_img = $baseUrl1 . '/images/user_img.png';
            }


            // Construct user data array
            $data[] = [
                'user_id' => $user_id,

                'user' => $udata,
                'user_img' => $user_img
            ];
            return $this->response->setJSON($data);
        } else {
            return $this->response->setStatusCode(400)->setBody('user not foruned');
        }
    }
    public function listCandidate_app_getByid($id)
    {
        $user = new CandidatesModel();
        $posts = $user->findUserById($id);

        if ($posts) {
            $data = []; // Initialize an array to hold all user data
            $phone = $posts['mobile_number'];
            $points = $posts['points'];

            $baseUrl = base_url(); // Assuming you have configured the base URL in your CodeIgniter configuration
            $baseUrl = str_replace('/public/', '/', $baseUrl);
            $user_id = $id;
            $user = new CandidatesModel();
            $udata = $user->getUserData($user_id);
            $profile = new ProfileModel();
            $baseUrl1 = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash
            $post1 = $profile->findByUId($user_id);

            if ($post1 !== null) {
                $resume1 = $post1['image_path'];

                // $resume1 = ltrim($resume11, '/');
                // echo $resume1;
                $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory


                if (file_exists($existingFilePath)) {
                    $user_img = $baseUrl1 . '/' . $resume1;
                } else {
                    $user_img = $baseUrl1 . '/images/user_img.png';
                }
            } else {
                $user_img = $baseUrl1 . '/images/user_img.png';
            }

            // work exp
            $work = $user->getby_id_data($user_id);
            // job pref
            $model3 = new Job_prefModel();
            $job_pre = $model3->show_userid($user_id);
            // reusme 4
            $model4 = new ResumeModel();
            $post4 = $model4->findByUId($user_id);
            if ($post4) {
                $resume3 = $post4['Resume'];
                $user_resume = $baseUrl . 'writable' . $resume3;
            } else {
                $user_resume = null;
            }
            // edu 
            $edu = $user->getUserEd_id($id);
            $ref = $user->getUserRefData($user_id);
            $model5 = new JobApplyModel();

            $job_app = $model5->getJobData($user_id);
            // echo "<pre>";
            // print_r($ref);
            // echo "</pre>";
            // die();


            // Construct user data array
            $data[] = [
                'user_id' => $user_id,
                'phone_number' => $phone,
                'points' => $points,
                'user' => $udata,
                'user_img' => $user_img,
                'work' => $work,
                'job_pref' => $job_pre,
                'job_app' => $job_app,
                'ref' => $ref,
                'user_edu' => $edu,
                'resume' => $user_resume
            ];

            return $this->response->setJSON($data);
        } else {
            return $this->response->setStatusCode(400)->setBody('user not foruned');
        }
    }

    public function store_prof_img($user_id, $input)
    {
        // Get the uploaded file
        $file = $input['profile_img'];


        // Check if the file is uploaded successfully
        if ($file->isValid() && !$file->hasMoved()) {

            // Move the file to the uploads folder
            $newName = $file->getRandomName();
            $file->move('uploads/profile/', $newName);

            // Save file information to the database
            $filepath = 'uploads/profile/' . $newName; // Relative path for storage
            // You may store other file details like $filename if needed

            $model = new ProfileModel();
            $existingProfile = $model->findByUId($user_id);
            // echo "<pre>";
            // print_r(    $existingProfile);
            // echo "</pre>";
            // die();

            // Handle existing profile image
            if ($existingProfile) {
                // Delete existing file if it exists
                $existingFilePath = FCPATH . $existingProfile['image_path'];
               
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            // Move the file to user's folder if needed
            $userFolder = FCPATH . 'uploads/profile/' . $user_id . '-img';

            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true); // Create user's folder if it doesn't exist
            }

            $newResumePath = $userFolder . '/' . $newName; // New path with folder
            rename('uploads/profile/' . $newName, $newResumePath); // Move to user's folder
            $res_p = '/uploads/profile/' . $user_id . '-img/' . $newName;
            // Update database with new file path

            $data = [
                'user_id' => $user_id,
                'image_path' => $res_p // Save the file path relative to 'uploads/profile/'
                // Add more information about the file as needed
            ];
           
            if ($existingProfile) {
                $model->update1($data); // Update existing profile record
            } else {
                $model->save($data); // Save new profile record
            }

            // Prepare data for view
            $post = $model->findByUId($user_id); // Fetch updated data
            $baseUrl = base_url(); // Get base URL from CI configuration
            $baseUrl = rtrim($baseUrl, '/') . '/'; // Ensure base URL ends with '/'

            $imagePath = $post['image_path'];

            if ($imagePath && file_exists($imagePath)) {
                $data['image_path'] = $baseUrl . $imagePath; // Full URL to uploaded image
            } else {
                $data['image_path'] = $baseUrl . 'images/user_img.png'; // Default image if not found
            }

            return $data; // Return data for further processing or display
        } else {
            // Handle file upload error
            return "Error uploading file";
        }
    }
}
