<?php

namespace Tests\Http\Controllers\Blog;

use App\Http\Controllers\Blog\ImagesController;
use Tests\TestCase;
use \Illuminate\Support\Facades\Auth as Auth;
use App\Models\User as User;
use App\Models\Admin\User as Admin;
use \Illuminate\Http\UploadedFile;

class ImagesControllerTest extends TestCase
{
    public $admin;
    public $user;

    public function CreateAdmin()
    {
        $this->admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $this->admin->id,
            'role_id' => 3,
        ]);
    }

    public function CreateUser()
    {
        $this->user = factory(User::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $this->user->id,
        ]);
    }

    public function DeleteAdmin()
    {
        \DB::table('users')->where('id', '=', $this->admin->id)->delete();
    }

    public function DeleteUser()
    {
        \DB::table('users')->where('id', '=', $this->user->id)->delete();
    }

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertViewIs('blog.mainboard');
    }

    public function testCreate()
    {
        $this->withoutExceptionHandling();
        $this->CreateAdmin();
        $response = $this->actingAs($this->admin)->get('admin/create');

        $response->assertViewIs('blog.admin.create');
        $this->DeleteAdmin();
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();
        $this->CreateAdmin();
        $response = $this->actingAs($this->admin)->post('/admin/store/', [
            'name' => 'Изображение',
            'image' => UploadedFile::fake()->create('test.png'),
        ]);

        $response->assertStatus(302);
        $this->DeleteAdmin();
    }

    public function testShow()
    {
        $temp_image = \DB::table('images')->latest()->first();
        $response = $this->get('show/' . $temp_image->id);
        $response->assertViewIs('blog.image');
    }

    public function testEdit()
    {
        $this->withoutExceptionHandling();
        $this->CreateAdmin();
        $temp_image = \DB::table('images')->latest()->first();
        $response = $this->actingAs($this->admin)->get('admin/edit/' . $temp_image->id);

        $response->assertViewIs('blog.admin.edit');
        $this->DeleteAdmin();
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $this->CreateAdmin();
        $temp_image = \DB::table('images')->latest()->first();
        $response = $this->actingAs($this->admin)->post('admin/update/' . $temp_image->id, [
            'name' => 'Изображение2',
            'image' => UploadedFile::fake()->create('test.png'),
        ]);

        $response->assertStatus(302);
        $this->DeleteAdmin();
    }

    public function testVote()
    {
        $this->withoutExceptionHandling();
        $this->CreateUser();
        $temp_image = \DB::table('images')->latest()->first();
        $response = $this->actingAs($this->user, 'api')->post('vote/' . $temp_image->id);

        $response->assertStatus(302);
        $this->DeleteUser();
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();
        $this->CreateAdmin();
        $temp_image = \DB::table('images')->latest()->first();
        $response = $this->actingAs($this->admin)->post('admin/destroy/' . $temp_image->id);

        $response->assertStatus(302);
        $this->DeleteAdmin();
    }

}
