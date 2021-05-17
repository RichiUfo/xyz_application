<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;

interface RegisterRepositoryInterface
{
    public function register(Request $request);
}