<?php

namespace App;

use App\Contracts\ResumeTokenInterface;
use Carbon\Carbon;
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
        'template',
        'data',
    ];

    /**
     * The name of the design templates.
     *
     * @var array
     */
    public static $templates = [
        //
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
     * the same privillage as of the owner of the resume even when they're not
     * authenticated in the application.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function generateToken() {
      $key = bcrypt(Carbon::now());

      $tokens = Cookie::get('resumes', []);
      array_push($tokens, [
          'key'       => $key,
          'resume_id' => $this->id
      ]);

      Cookie::forever('resumes', $tokens);
      return $this->token()->create([
          'key' => $key
      ]);
    }

    /**
     * Determines whether the resume contains a token and is valid for the
     * user's browser.
     *
     * @return bool
     */
    public function validateToken(): bool {
        if (! $this->token->exists()) {
            return false;
        }

        $tokens = Cookie::get('resumes', []);
        $token = array_where($tokens, function ($token) {
            return $token['resume_id'] === $this->id && $token['key'] === $this->token->key;
        });

        if (count($token) > 0) {
            return true;
        }

        return false;
    }
}
