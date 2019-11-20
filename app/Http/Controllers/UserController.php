<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of user
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * Create new user
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();

        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtain and show user
     * @return Illuminate\Http\Response
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return $this->validResponse($user);
    }

    /**
     * Update user
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:user,email,' . $userId,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($userId);

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
    }

    /**
     * Deletes user
     * @return Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        $user->delete();

        return $this->validResponse($user);
    }
}
