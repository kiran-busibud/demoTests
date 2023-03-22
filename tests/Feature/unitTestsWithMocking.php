<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
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
        $user->shouldReceive('findOrFail')
            ->once()
            ->andReturn($user);

        $userRepository = Mockery::mock(UserRepository::class);

        $userRepository->shouldReceive('getUserById')
            ->once()
            ->with(1)
            ->andReturn($user);

        $result = $userRepository->getUserById(1);

        $this->assertEquals($user, $result);
    }
}
