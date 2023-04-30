<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class AdminAccessTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdminCanBan(){
    $admin = User::factory()->create(['is_admin'=>1]);
    $user = User::factory()->create();
    $response = $this->actingAs($admin)->post(route('user.block',$user));
    $response->assertStatus(302);
    $response->assertSessionHas('success');
        $this->assertEquals(1, $user->fresh()->is_blocked);

    }
    public function testAdminCanUnban(){
        $admin = User::factory()->create(['is_admin'=>1]);
        $user = User::factory()->create(['is_blocked'=>1]);
        $response = $this->actingAs($admin)->post(route('user.unblock',$user));
        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertEquals(0, $user->fresh()->is_blocked);
    }
    public function testAdminCanMute(){
    $admin = User::factory()->create(['is_admin'=>1]);
    $user = User::factory()->create();
    $response = $this->actingAs($admin)->post(route('user.mute',$user));
    $response->assertStatus(302);
    $response->assertSessionHas('success');
    $this->assertNotNull($user->fresh()->mute_until);
    }
}
