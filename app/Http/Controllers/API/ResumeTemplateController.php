<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Resume;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeTemplateController extends Controller
{
    /**
     * Returns the list of resume design templates.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTemplates() {
        return response()->json(
            Resume::getTemplates()
        );
    }
}
