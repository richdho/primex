<?php 
namespace App\Repositories;


class UserRepository implements UserRepositoryInterface
{
	public function getAll()
	{
		return \App\User::with(['roles'])->get();
	}

	public function getById($id)
	{
		return \App\User::with(['roles'])->findOrFail($id);
	}

	public function create($user)
	{
		$newUser = \App\User::create($user->except(['roles']));
		$newUser->roles()->attach($user->input('roles'));
	}
}