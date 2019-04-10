<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'roles'=> 'required|array'
        ]);
        
        $this->repository->create($request);
        return response()->json(['message'=>'OK'])->setStatusCode(201,'created');
    }
}