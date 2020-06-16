<?php

namespace Tests\Http\Controllers\Blog;

use App\Http\Controllers\Blog\ImagesController;
use Tests\TestCase;
use \Illuminate\Support\Facades\Auth as Auth;
use App\Models\User as User;
use App\Models\Admin\User as Admin;

class ImagesControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertViewIs('blog.mainboard');
    }

    public function testCreate()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->get('admin/create');

        $response->assertViewIs('blog.admin.create');
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->get('admin/store/1');

        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get('show/2');
        $response->assertViewIs('blog.image');
    }

    public function testEdit()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->get('admin/edit/1');

        $response->assertViewIs('blog.admin.edit');
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->post('admin/update/1', [
            'name' => 'new_name',
            'image' => file('public/blog_images/image1.jpg'),
        ]);

        $response->assertStatus(302);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->get('admin/destroy/1');

        $response->assertStatus(200);
    }

    public function testVote()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->post('vote/1');
        $response->assertStatus(302);
    }

}
