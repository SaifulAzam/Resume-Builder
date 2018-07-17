<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Resume;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SnappyImage;

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
     * 
     * @return string
     */
    public function getPreview(Request $request) {
        $request->validate([
            'author_id' => 'exists:users,id',
            'data'      => 'required',
            'template'  => 'required|string',
            'title'     => 'required|string',
        ]);

        $author = null;

        if ($request->has('author_id')) {
            $author = User::findOrFail($request->input('author_id'));
        }

        $data     = json_decode($request->input('data'));
        $template = $request->input('template');
        $title    = $request->input('title');

        // Extract out the contact information from the data so it can be
        // reused easily whenever required in the future by the templates.
        $contact_info = array_filter($data, function ($temp) {
            return $temp->type === 'contact-information';
        });

        // Finally, we can generate a preview of the resume and store it
        // in the asset to return back the image url to the client
        // application to reuse it as they want.
        $filename = sha1(Carbon::now()) . '.png';
        $filelocation = public_path('uploads/previews/' . $filename);

        SnappyImage::loadView('resumes.' . $template . '.index', [
            'author'       => $author,
            'contact_info' => $contact_info[0],
            'data'         => $data,
            'template'     => $template,
            'title'        => $title,
        ])
            ->setOption("width", 868)
            ->setOption("height", 1035)
            ->setOption("crop-w", 868)
            ->setOption("crop-h", 1035)
            ->setOption("disable-smart-width", true)
            ->setOption("zoom", 1)
            ->save($filelocation);

        return asset('thumbnails/' . $filename);
    }

    /**
     * Returns the list of resume templates.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTemplates() {
        return response()->json(
            Resume::getUnignoredTemplates()
        );
    }
}
