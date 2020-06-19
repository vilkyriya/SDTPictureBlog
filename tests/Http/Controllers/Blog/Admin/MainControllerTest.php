<?php

namespace Tests\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\Admin\MainController;
use Tests\TestCase;
use App\Models\Admin\User as Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();

        if (\DB::table('users')->count() >= 1)
        {
            \DB::table('user_roles')->where('user_id', '=', $admin->id)->update(array('role_id' => 3));

            $response = $this->actingAs($admin, 'api')->get('admin/index');
            $response->assertViewIs('blog.admin.index');
            \DB::table('users')->where('id', '=', $admin->id)->delete();
        }
        else {
            $response = $this->actingAs($admin, 'api')->get('/');
            $response->assertStatus(302);
        }
    }
}
