<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\Controllers\RegisterTrait;

class RegisterRepository implements RegisterRepositoryInterface
{

    use RegisterTrait;

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required|max:100',
            'state' => 'required|max:100',
            'country' => 'required|max:100',
            'zip' => 'required|max:20',
            'phoneNo1' => 'required|max:20',
            'phoneNo2' => 'max:20',
            'user.email'    => 'unique:users,email|required',
            'user.password' => 'required|min:3',
            'user.passwordConfirmation' => 'required||min:3|same:user.password',
        ];

        $input     = $request->all();
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()],422);
        }

        $client = $this->ClientRegister($request);
        $request->merge([
            'client_id' => $client->id,
        ]);
        $user = $client->user()->create($this->getUserData($request));

        return response()->json($client->registerFormat(), 201);
    }

    public function getUserData(Request $request)
    {
        $request_user = collect($request->user);
        return [
            'first_name'=>$request_user->get('firstName'),
            'last_name'=>$request_user->get('lastName'),
            'email'=>$request_user->get('email'),
            'password'=>$request_user->get('password'),
            'phone'=>$request_user->get('phone'),
            'profile_uri'=>url('user/profile', [$request->client_id])
        ];
    }

}