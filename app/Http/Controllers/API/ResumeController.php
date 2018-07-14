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
     */
    public function getPreview(Request $request) {
        $request->validate([
            'author_id'          => 'exists:users,id',
            'data'               => 'required',
            'template'           => 'required|string',
            'title'              => 'required|string',
        ]);

        $author = null;

        if ($request->has('author_id')) {
            $author = User::findOrFail($request->input('author_id'));
        }

        $data     = json_decode($request->input('data'));
        $template = $request->input('template');
        $title    = $request->input('title');

        $contact_info = array_filter($data, function ($temp) {
            return $temp->type === 'contact-information';
        });

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
     * Returns the list of resume design templates.
     */
    public function getTemplates() {
        return response()->json(
            Resume::getTemplates()
        );
    }
}
