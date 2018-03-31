<?php

namespace App\Http\Controllers;

use App\Contracts\ResumeInterface;
use Illuminate\Http\Request;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeController extends Controller implements ResumeInterface
{
    /**
     * Creates a new resume for the user.
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int $user_id
     * 
     * @return void
     */
    public function createResume(Request $request, $user_id) {
        // 
    }

    /**
     * Deletes the resume with supplied resume id.
     * 
     * @param  int $resume_id
     * 
     * @return void
     */
    public function deleteResume($resume_id) {
        // 
    }

    /**
     * Displays all the resumes.
     * 
     * @param  int $user_id
     * 
     * @return void
     */
    public function showAllResumes($user_id = null) {
        // We'll determine whether resumes are being requested of a
        // particular user or all and then display the resumes
        // accordingly.
        if (! empty($user_id)) {
            // 
        }
    }

    /**
     * Displays the resume with supplied resume id.
     * 
     * @param  int $resume_id
     * 
     * @return void
     */
    public function showResume($resume_id) {
        // 
    }

    /**
     * Updates the resume with new supplied details.
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int $resume_id
     * 
     * @return void
     */
    public function updateResume(Request $request, $resume_id) {
        // 
    }
}
