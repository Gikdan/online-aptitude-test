<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\Permission;
use App\Models\UserType;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::getAll()
            ->map(function($user) {
                return $user->parse();
            });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return [ 
    
            'user_types' => UserType::get(['id', 'name'])
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username'
            //'user_type_id' => 'required|exists:user_types,id'
        
        ]);

        $data = $request->all();
        $password = bcrypt(mt_rand(100000, 999999));
        $data['password'] = $password;

        $user = User::create($data);


        return $user->parse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::getAll($id)->parse();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->create();
        $data['user'] = $this->show($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'id_number' => 'required',
            'email' => 'required',
            'username' => 'required',
            'branch_id' => 'required'
        ]);

        $user = User::getAll($id);

        $user->update($request->all());

        return $user->parse();
    }

    public function auth(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::getAll($id);

        $data = [
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ];

        $user->update($data);

        return [
            'success' => 1
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return [
            'success' => 1
        ];
    }
}
