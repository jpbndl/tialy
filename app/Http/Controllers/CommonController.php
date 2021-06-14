<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\UserRepository;
use App\Http\Requests\LoginRequest;

class CommonController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request) {
        return $this->userRepository->login($request);
    }
    
}
