<?php

namespace Tests\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\Admin\MainController;
use Tests\TestCase;
use App\Models\Admin\User as Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->withoutExceptionHandling();

        $data = [
            ['id'=> 3, 'name'=> 'admin'],
            ['id'=> 2, 'name'=> 'user'],
        ];
        \DB::table('roles')->insert($data);

        $admin = factory(Admin::class)->create();

        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin)->get('admin/index');
        $response->assertViewIs('blog.admin.index');
        \DB::table('users')->where('id', '=', $admin->id)->delete();
    }
}
