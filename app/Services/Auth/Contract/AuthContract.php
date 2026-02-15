<?php

namespace App\Services\Auth\Contract;


use Illuminate\Http\Request;

interface AuthContract
{
    public  function login(array $data);
    public  function loginByEmail(array $data);
    public function logout(Request $request);
    public function register(array $data);

}
