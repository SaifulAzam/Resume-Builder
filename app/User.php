<?php

namespace App;

use Faker\Generator as Faker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        return $this->hasMany(Resume::class);
    }

    /**
     * Creates a random user.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function createRandomUser() {
        $faker = new Faker();
        $user  = self::generateUsername();

        return User::create([
            'email'    => self::generateEmail(),
            'name'     => $user,
            'username' => $user,
            'password' => Hash::make($faker->sha256)
        ]);
    }

    /**
     * Generates a random email that's truly unique and needed not to
     * be checked for uniqueness back again.
     *
     * @return string
     */
    public static function generateEmail() : string {
        $faker = new Faker();
        $email = $faker->unique()->safeEmail;

        $emails = User::pluck('email')->toArray();

        // Return the generated email if it doesn't exist in the
        // Database.
        if (!in_array($email, $emails)) {
            return $email;
        }

        // Generate the mail again if it exists in the emails.
        do {
            $email = $faker->unique()->safeEmail;
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
