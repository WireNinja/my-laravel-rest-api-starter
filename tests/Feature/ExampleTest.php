<?php

it('rest api crud /users returns a successful response', function () {
    $response = $this->get('/api/users');

    $response->assertStatus(200);
    $response->assertJson([
        'meta' => [
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
        ],
    ]);

    // do post to create user
    $response = $this->post('/api/users', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ]);
    $response->assertStatus(201);
    $response->assertJson([
        'meta' => [
            'status' => 'success',
            'code' => 201,
            'message' => 'User created',
        ],
    ]);

    // do get to show user
    $response = $this->get('/api/users/1');
    $response->assertStatus(200);
    $response->assertJson([
        'meta' => [
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
        ],
    ]);

    // do put to update user
    $response = $this->put('/api/users/1', [
        'name' => 'John Doe Update',
        'email' => 'johndoeupdate@example.com',
        'password' => 'password',
    ]);
    $response->assertStatus(201);
    $response->assertJson([
        'meta' => [
            'status' => 'success',
            'code' => 201,
            'message' => 'User updated',
        ],
    ]);

    // do delete to delete user
    $response = $this->delete('/api/users/1');
    $response->assertStatus(200);
    $response->assertJson([
        'meta' => [
            'status' => 'success',
            'code' => 200,
            'message' => 'User deleted',
        ],
    ]);
});
