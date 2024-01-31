<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExpenseTest extends TestCase
{

    protected string $emailTest = 'teste@onfly.com.br';
    protected string $passwordTest = '123456';

    /**
     * @test
     */
    public function check_expenses_response_status_401_when_not_logged()
    {
        $response = $this->get('/api/expenses');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function check_list_expenses_response_status_200_when_logged()
    {
        $response = $this->json('post', '/api/auth/login', [
            'email' => $this->emailTest,
            'password' => $this->passwordTest
        ]);
        $content = json_decode($response->getContent());
        $token = $content->access_token;
        $response = $this->json('get', '/api/expenses', [], [
            'Authorization' => 'bearer '. $token
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function check_create_new_expense_response_status_201()
    {
        $data = [
            'date' => date('Y-m-d'),
            'description' => 'test',
            'value' => 10.99
        ];
        $token = $this->getAccessToken();
        $response = $this->json('post', '/api/expenses', $data, [
            'Authorization' => 'bearer '. $token
        ]);
        $response->assertStatus(201);
    }

    protected function getAccessToken(): string
    {
        $response = $this->json('post', '/api/auth/login', [
            'email' => $this->emailTest,
            'password' => $this->passwordTest
        ]);
        $content = json_decode($response->getContent());
        return $content->access_token;
    }
}
