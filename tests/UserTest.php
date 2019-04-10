<?php

class UserTest extends TestCase
{

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

}