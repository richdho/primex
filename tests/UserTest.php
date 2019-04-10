<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    //use DatabaseTransactions;
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
        $random = substr(md5(mt_rand()), 0, 7);
        $response = $this->call('POST', '/users',[
            'name' => 'Test1',
            'email' => 'test1'.$random.'@gmail.com',
            'roles' => [1,3],
            'password' => app('hash')->make('test123'),
        ]);

        //var_dump($response);

        $this->assertEquals(201, $response->status());
    }

    public function testUpdateOneUser()
    {
        $random = substr(md5(mt_rand()), 0, 7);
        $user = \App\User::first();
        $response = $this->call('PUT', '/users/'.$user->id,[
            'name' => 'Test'.$random,
            'roles' => [2,3],
            'password' => app('hash')->make($random),
        ]);

        //var_dump($response);

        $this->assertEquals(202, $response->status());
    }


    /**
     *
     *
     * @return void
     */
    public function testDeleteOneUser()
    {
        $user = \App\User::orderby('created_at', 'desc')->first();
        $this->json('DELETE', '/users/'.$user->id)
             ->seeJson([
                'message' => 'OK'
             ]);
    }

    /**
     *
     *
     * @return void
     */
    public function testDeleteMultipleUsers()
    {
        $users = \App\User::orderby('created_at', 'desc')->take(2)->get();
        //var_dump($users[0]->id);exit();
        $this->json('POST', '/users/batch-delete',[
                'ids' => [
                $users[0]->id,
                $users[1]->id
                ]
             ])
             ->seeJson([
                'message' => 'OK'
             ]);
    }

}