<?php

namespace App\Contracts;

use Illuminate\Http\Request;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
interface ResumeInterface {
    public function createResume(Request $request, $user_id);
    public function deleteResume($resume_id);
    public function showAllResumes($user_id = null);
    public function showResume($resume_id);
    public function updateResume(Request $request, $resume_id);
}