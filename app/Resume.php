<?php

namespace App;

use App\Contracts\ResumeTokenInterface;
use Carbon\Carbon;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Resume extends Model implements ResumeTokenInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'template',
        'title'
    ];

    /**
     * Defines the relationship between the user and their resumes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class);
    }

    /**
     * Defines the relationship between the resume and its token.
     * .
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token() {
        return $this->hasOne(ResumeToken::class);
    }

    /**
     * Generates a token that gets stored into the user's browser so they enjoy
     * the same privilege as of the owner of the resume even when they're not
     * authenticated in the application.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function generateToken() {
        $key = bcrypt(Carbon::now());

        $tokens = Cookie::get('resumes', null);
        $tokens = ! empty($tokens) ? json_decode($tokens) : [];

        array_push($tokens, [
            'key'       => $key,
            'resume_id' => $this->id
        ]);

        Cookie::queue('resumes', json_encode($tokens), "2628000");
        return $this->token()->create([
            'key' => $key
        ]);
    }

    /**
     * Returns the available templates for the resume.
     * 
     * @return array
     */
    public static function getTemplates() : array {
        $templates_path  = resource_path("views\\resumes\\");
        $templates       = array_values(array_filter(glob($templates_path . "*"), "is_dir"));
        $thumbnails_path = public_path("uploads\\template_thumbnails\\");

        $templates = array_map(function ($template) use ($templates_path, $thumbnails_path) {
            $name = basename($template);
            $thumbnail_path = $thumbnails_path . $name . ".jpg";

            if (! file_exists($thumbnail_path)) {
                $temp_thumbail_path = $templates_path . $name . "\\thumbnail.jpg";

                if (file_exists($temp_thumbail_path)) {
                    File::copy($temp_thumbail_path, $thumbnail_path);
                }
            }

            $thumbnail = asset("uploads/template_thumbnails/" . $name . ".jpg");

            return [
                'name'    => $name,
                'preview' => $thumbnail
            ];
        }, $templates);

        return $templates;
    }

    /**
     * Determines whether the resume contains a token and is valid for the
     * user's browser.
     *
     * @return bool
     */
    public function validateToken(): bool {
        if (! $this->token()->exists()) {
            return false;
        }

        $tokens = Cookie::get('resumes', null);
        $tokens = ! empty($tokens) ? json_decode($tokens) : [];

        $token = array_where($tokens, function ($token) {
            return $token->resume_id === $this->id && $token->key === $this->token->key;
        });

        if (count($token) > 0) {
            return true;
        }

        return false;
    }
}
