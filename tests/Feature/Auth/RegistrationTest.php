<?php

use App\Http\Resources\UserResource;
use App\Models\User;

it('registers a new user successfully', function () {
    $data = [
        'name' => 'Mohamed Harby',
        'email' => 'test@example.com',
        'password' => 'passwor@Fd123',

    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(201)-> // المفروض يرجع 201 لو اتسجل
    assertJsonStructure(
        ['data'=>['id','name','email'],'token']
    );


    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});
