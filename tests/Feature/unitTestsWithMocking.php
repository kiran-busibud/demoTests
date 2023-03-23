<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;

class unitTestsWithMocking extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use DatabaseTransactions;

    public function testGetUserById()
    {

        $user = Mockery::mock(User::class);
        $user1 = new User($userData = ['name' => 'kiran', 'email' => 'kiran']);
        $user->shouldReceive('findOrFail')
            ->once()
            ->with(202)
            ->andReturn($user1);

        $userRepository = new UserRepository($user);

        $result = $userRepository->getUserById(202);

        $this->assertEquals($user1->name, $result->name);
    }

    public function testCreateUser()
    {
        $userRepository = $this->createMock(UserRepository::class);
        
        $userData = ['name' => 'kiran', 'email' => 'kiran'];
        $user = new User($userData);
        $userRepository->expects($this->once())
            ->method('create')
            ->with($user);
            
        $userService = new UserService($userRepository);
        
        $userService->createUser($userData);
    }

}
