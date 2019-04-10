<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
    	return response()->json(['users'=>$this->repository->getAll()]);
    }

    public function show($id)
    {
        return response()->json(['user'=>$this->repository->getById($id)]);
    }
}