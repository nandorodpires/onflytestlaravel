<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @test
     */
    public function check_has_token_attribute_when_login()
    {
        $email = 'teste@onfly.com.br';
        $password = '123456';
        $response = $this->json('post', '/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);
        $content = json_decode($response->getContent());
        $this->assertObjectHasProperty('access_token', $content);
    }
}
