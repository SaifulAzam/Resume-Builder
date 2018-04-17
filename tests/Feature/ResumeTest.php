<?php

namespace Tests\Feature;

use App\Resume;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_show_all_resumes_for_authenticated_user()
    {
        $user = factory(User::class)->create();
        $user->resumes()->saveMany(factory(Resume::class, 5)->make());

        $response = $this->actingAs($user)->get(route('users.resumes', ['user_id' => $user->id]));

        $response->assertStatus(200);
    }
}
