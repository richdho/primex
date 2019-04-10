<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * 
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $this->json('GET', '/users')
             ->seeJsonStructure([
                'users' => [
                    0 => [
                        'id',
                        'name',
                        'roles',
                        'created_at',
                        'updated_at',
                        'deleted_at'
                    ]
                ],
             ]);
    }

    /**
     *
     *
     * @return void
     */
    public function testGetOneUser()
    {
        $user = \App\User::first();
        $this->json('GET', '/users/'.$user->id)
             ->seeJsonStructure([
                'user' => [
                        'id',
                        'name',
                        'roles',
                        'created_at',
                        'updated_at',
                        'deleted_at'
                ],
             ]);
    }

    public function testCreateOneUser()
    {
        $response = $this->call('POST', '/users',[
            'name' => 'Test1',
            'email' => 'test1@gmail.com',
            'roles' => [1,3],
            'password' => app('hash')->make('test123'),
        ]);

        $this->assertEquals(201, $response->status());
    }

}