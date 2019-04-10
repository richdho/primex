<?php 
namespace App\Repositories;

interface UserRepositoryInterface {
    public function getAll();
    public function getById($id);
    public function create($user);
    public function update($user,$id);
    public function delete($id);
}