<?php

namespace Tests\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\Admin\MainController;
use Tests\TestCase;
use \Illuminate\Support\Facades\Auth as Auth;
use App\Models\Admin\User as Admin;

class MainControllerTest extends TestCase
{

    public function testIndex()
    {
        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();
        \DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => 3,
        ]);

        $response = $this->actingAs($admin, 'api')->get('admin/index');
        $response->assertStatus(200);
    }
}
