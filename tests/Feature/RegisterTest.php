<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanRegister(){
        $response = $this->post('register', [
            'name'=>'test',
            'email'=>'test@mail.ru',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
           'name'=>'test',
           'email'=>'test@mail.ru',
        ]);
    }
    public function testUserCannotRegisterWithSameName(){
        $response = $this->post('register', [
            'name'=>'test',
            'email'=>'test@mail.ru',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name'=>'test',
            'email'=>'test@mail.ru',
        ]);
        $responseTwo = $this->post('register', [
            'name'=>'test',
            'email'=>'asesd@mail.ru',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        $this->assertDatabaseMissing('users', [
            'name'=>'test',
            'email'=>'asesd@mail.ru',
        ]);
    }
}
