<?php


namespace Tests\Feature;


use App\Account;
use App\Enums\TransactionType;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class TransactionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_insert_where_type_is_bill_payment()
    {
        $payload = [
            'value' => $this->faker->randomFloat(2),
            'type' => TransactionType::Bill_Payment()->key,
            'receiver_account_id' => factory(Account::class)->create()->id,
            'sender_account_id' => factory(Account::class)->create()->id,
        ];

        $response = $this->post('/api/transaction', $payload);
        $response->assertStatus(201);
    }

    public function test_insert_where_type_is_transfer()
    {
        $payload = [
            'value' => $this->faker->randomFloat(2),
            'type' => TransactionType::Transfer()->key,
            'receiver_account_id' => factory(Account::class)->create()->id,
            'sender_account_id' => factory(Account::class)->create()->id,
        ];

        $response = $this->post('/api/transaction', $payload);
        $response->assertStatus(201);
    }

    public function test_insert_where_type_is_telephone_recharge()
    {
        $payload = [
            'value' => $this->faker->randomFloat(2),
            'type' => TransactionType::Telephone_Recharge()->key,
            'receiver_account_id' => factory(Account::class)->create()->id,
            'sender_account_id' => factory(Account::class)->create()->id,
        ];

        $response = $this->post('/api/transaction', $payload);
        $response->assertStatus(201);
    }

    public function test_insert_where_type_is_credit()
    {
        $payload = [
            'value' => $this->faker->randomFloat(2),
            'type' => TransactionType::Credit()->key,
            'receiver_account_id' => factory(Account::class)->create()->id,
            'sender_account_id' => factory(Account::class)->create()->id,
        ];

        $response = $this->post('/api/transaction', $payload);
        $response->assertStatus(201);
    }


    public function test_insert_where_type_is_deposit()
    {
        $payload = [
            'value' => $this->faker->randomFloat(2),
            'type' => TransactionType::Deposit()->key,
            'receiver_account_id' => factory(Account::class)->create()->id,
            'sender_account_id' => factory(Account::class)->create()->id,
        ];

        $response = $this->post('/api/transaction', $payload);
        $response->assertStatus(201);
    }

}
