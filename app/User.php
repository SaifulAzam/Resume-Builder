<?php

namespace App;

use Faker\Factory as Faker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class User extends Authenticatable
{
    use Billable, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Defines the relationship between the user and their resumes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resumes() {
        return $this->hasMany(Resume::class, 'author_id');
    }

    /**
     * Creates a random user.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function createRandomUser() {
        $faker    = Faker::create();
        $username = self::generateUsername();

        return app('\App\Http\Controllers\Auth\RegisterController')->create([
            'email'    => self::generateEmail(),
            'name'     => $username,
            'password' => $faker->sha256,
            'username' => $username,
        ]);
    }

    /**
     * Generates a random email that's truly unique and needed not to
     * be checked for uniqueness back again.
     *
     * @return string
     */
    public static function generateEmail() : string {
        $faker = Faker::create();
        $email = $faker->safeEmail;

        $emails = User::pluck('email')->toArray();

        // Return the generated email if it doesn't exist in the
        // Database.
        if (!in_array($email, $emails)) {
            return $email;
        }

        // Generate the mail again if it exists in the emails.
        do {
            $email = $faker->safeEmail;
        } while (in_array($email, $emails));

        return $email;
    }

    /**
     * Generates a random username that's truly unique and needed not to
     * be checked for uniqueness back again.
     *
     * @return string
     */
    public static function generateUsername() : string {
        $username = 'user' . rand(0, 10000);

        // List all the usernames that exists in the Database.
        $usernames = User::pluck('username')->toArray();

        // Return the generated username if it doesn't exist in the
        // Database.
        if (!in_array($username, $usernames)) {
            return $username;
        }

        // Suffix random numbers until it becomes unique and return.
        do {
            $username .= rand(0, 9);
        } while (in_array($username, $usernames));

        return $username;
    }
}
