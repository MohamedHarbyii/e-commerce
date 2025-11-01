<?php

test('the logout for the user', function () {
    $response = $this->get('/api/logout');

    $response->assertStatus(204)->assertJson(['data'=>null,'message'=>'user logged out successfully']);
});
