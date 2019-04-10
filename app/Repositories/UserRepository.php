<?php 
namespace App\Repositories;


class UserRepository implements UserRepositoryInterface
{
	public function getAll()
	{
		return \App\User::with(['roles'])->get();
	}

}