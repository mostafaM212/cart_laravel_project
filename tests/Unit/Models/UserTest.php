<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_the_required_name()
    {


        $user =factory(User::class)->create([
            'password'=>123
        ]);

//        $this->assertNotEquals);

    }
}
