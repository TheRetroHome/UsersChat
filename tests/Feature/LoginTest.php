<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanLoginWithCorrectData(){
        $user = User::factory()->create([
           'password'=>bcrypt($password = 'password')
        ]);
        $response = $this->post('login', [
           'name'=>$user->name,
           'password'=>$password,
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
    public function testUserCannotLoginWithIncorrectData(){
        $user = User::factory()->create([
           'password'=>bcrypt($password = 'password'),
        ]);
        $response = $this->post('login', [
           'name'=>$user->name,
           'password'=>'123123123',
        ]);
        $this->assertGuest();
    }
}
