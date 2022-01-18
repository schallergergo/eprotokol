<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

     public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/user/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request();

        //validation rules
        $data=$data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' =>[],
            'username' => ['required', 'string',  'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

        if ($data["role"]=="penciler") {
            
            $this->storePenciler($data);
        }

        else $this->storeAdmin($data);
        return redirect("/home");
    }
private function storePenciler(array $data){

        $this->authorize('createPenciler',User::class);

      $newEvent=\App\Models\User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'role' =>$data["role"],
            'email_verified_at' => '2021-10-10 20:46:09',
            'username' => $data["username"],
            'password' => Hash::make($data['password']),
        ]);

}

private function storeAdmin(array $data){
    $this->authorize('isAdmin',User::class);
      $newEvent=\App\Models\User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'role' =>$data["role"],
            'email_verified_at' => '2021-10-10 20:46:09',
            'username' => $data["username"],
            'password' => Hash::make($data['password']),
        ]);

}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
