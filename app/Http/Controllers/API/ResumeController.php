<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Resume;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeController extends Controller
{
    /**
     * Generates a preview for the resume.
     * 
     * @param  Request $request
     */
    public function getPreview(Request $request) {
        // 
    }

    /**
     * Returns the list of resume design templates.
     */
    public function getTemplates() {
        return response()->json(
            Resume::getTemplates()
        );
    }
}
