<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AccountsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        factory(User::class)->create([
            'name' => 'Joao Carlos'
        ]);

        factory(User::class)->create([
            'name' => 'Maria Joaquina',
            'email' => 'maria@example.com',
            'cpf' => '362.842.150-02'
        ]);

        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
        $this->faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($this->faker));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_retry_all_users()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    /**
     * @throws \Throwable
     */
    public function test_search_for_name_joao_in_users(){
        $response = $this->get('/api/users?q=joao');
        $response->assertStatus(200);
        $this->assertStringStartsWith('Joao', $response->decodeResponseJson()[0]['name']);
    }

    public function test_search_for_name_other_than_joao_in_users(){
        $response = $this->get('/api/users?q=maria');
        $response->assertStatus(200);
        $this->assertStringStartsNotWith('Joao', $response->decodeResponseJson()[0]['name']);
    }

    public function test_insert_new_users()
    {
        $email = $this->faker->unique()->safeEmail;
        $payload = [
            'name' => $this->faker->name,
            'email' => $email,
            'cpf' => $this->faker->cpf,
            'telephone' => $this->faker->cellphoneNumber,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd',
        ];

        $response = $this->post('/api/users', $payload);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    public function test_insert_new_users_no_with_password_confirmation(){
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->cpf,
            'telephone' => $this->faker->cellphoneNumber,
            'password' => 'P@ssw0rd',
        ];

        $response = $this->post('/api/users', $payload);
        $response->assertStatus(422);
    }

    public function test_insert_new_users_with_invalid_cpf(){
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => '362.842.150-03',
            'telephone' => $this->faker->cellphoneNumber,
            'password' => 'P@ssw0rd',
        ];

        $response = $this->post('/api/users', $payload);
        $response->assertStatus(422);
    }

    public function test_insert_new_users_with_duplicate_cpf(){
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => '362.842.150-02',
            'telephone' => $this->faker->cellphoneNumber,
            'password' => 'P@ssw0rd',
        ];

        $response = $this->post('/api/users', $payload);
        $response->assertStatus(422);
    }

    public function test_insert_new_users_with_duplicate_email(){
        $payload = [
            'name' => $this->faker->name,
            'email' => 'maria@example.com',
            'cpf' => $this->faker->cpf,
            'telephone' => $this->faker->cellphoneNumber,
            'password' => 'P@ssw0rd',
        ];

        $response = $this->post('/api/users', $payload);
        $response->assertStatus(422);
    }

    public function test_insert_delete_users(){
        $user = factory(User::class)->create();
        $response = $this->delete('/api/users/' . $user->id);
        $response->assertStatus(201);
    }

    public function test_insert_delete_users_with_not_exists(){
        $response = $this->delete('/api/users/0');
        $response->assertStatus(400);
    }

    /**
     * @throws \Throwable
     */
    public function test_update_users()
    {
        $user = factory(User::class)->create();
        $oldName = $user->name;
        $response = $this->put('/api/users/' . $user->id,[
            'name' => $this->faker->name
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['name' => $oldName]);

        $this->assertNotEquals($oldName, $response->decodeResponseJson()['name']);
    }
}
