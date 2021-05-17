<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;

interface CustomerRepositoryInterface
{
    public function all(Request $request);
}