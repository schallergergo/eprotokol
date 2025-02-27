<?php



namespace App\Http\Controllers;



use App\Models\User;

use App\Models\Start;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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

        $users=User::paginate(20);

        return view("user.index",["users"=>$users]);

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

      $newUser=\App\Models\User::create([

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

        $clubs=User::all();

        return view("user.profile",["user"=>$user,"clubs"=>$clubs]);

    }



    public function search(){



        //$this->authorize('isAdmin',User::class);



        $data = request();











        $data=$data->validate([



            'search' => ["string","max:256","nullable"],



            ]);

        if (count($data)==0) $data = ["search"=>null];

        $searchTerm=$data["search"];

        $users=User::where("username","LIKE",$searchTerm)->orWhere("name","LIKE","%".$searchTerm."%")->paginate(20);

        return view("home",["users"=>$users,"search"=>$searchTerm]);



    }







    public function profile()

    {

        $user=Auth::User();

        if ($user==null) return redirect("/login");

        $clubs=User::where("role","club")->orderBy("name")->get();



        return view("user.profile",["user"=>$user,"clubs"=>$clubs]);

    }

    



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Models\User  $user

     * @return \Illuminate\Http\Response

     */

    public function update(User $user)

    {

         $data = request();

         $newData=$data->validate([

            'name' => ['required', 'string', 'max:255'],

            'club' =>['required', 'integer']

            ]);



         $user->update($newData);



             if ($data["email"]!=$user->email)

            {

                $email = $data->validate([ 'email' => ['required', 'string', 'email', 'max:255','unique:users']]);

                $user->email=$email["email"];

                $user->save();

            }

            





         

         return redirect()->back();



    }



    public function editAsAdmin(User $user)

    {   

        $this->authorize('isAdmin', $user);

        if ($user==null) return redirect("/login");

        $clubs=User::where("role","club")->orderBy("name")->get();

        $starts = Start::where("rider_id",$user->username)->limit(1)->get();

        $clubByStart = "";

        if (count($starts)>0) $clubByStart = $starts->first()->club;

        return view("user.editAsAdmin",["user"=>$user,"clubs"=>$clubs,"clubByStart"=>$clubByStart]);

    }



 public function updateAsAdmin(User $user)

    {$this->authorize('isAdmin', $user);

         $data = request();

         $newData=$data->validate([

            'name' => ['required', 'string', 'max:255'],

            'role'=> ['required',Rule::in(["admin","club","rider","office","penciler"])],

            'club' =>['required', 'integer'],
            
            'email_verified_at'=>['nullable']


            ]);



    if ($data["email"]!=$user->email)

            {

                $email = $data->validate([ 'email' => ['required', 'string', 'email', 'max:255','unique:users']]);



                $user->email=$email["email"];

                $user->save();

            }

            

     if ($data["username"]!=$user->username)

            {

                 $username = $data->validate([ 'username' => ['required', 'string',  'max:255', 'unique:users']]);



                $user->username=$username["username"];

                $user->save();

            }









         $user->update($newData);

         return redirect()->back();



    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Models\User  $user

     * @return \Illuminate\Http\Response

     */

    public function destroy(User $user)

    {

        $this->authorize('isAdmin', $user);
        $user->delete();
        return redirect()->back();


    }



}

