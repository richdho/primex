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
	public function update($user,$id)
	{
		$oldUser = \App\User::findOrFail($id);
		$oldUser->fill($user->except(['roles','email']));
		$oldUser->save();
		$oldUser->roles()->detach();
		$oldUser->roles()->attach($user->input('roles'));
	}
	public function delete($id)
	{
		
	}
}