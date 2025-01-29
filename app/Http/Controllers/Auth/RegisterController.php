<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;

use App\Models\User;

use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;



class RegisterController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Register Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users as well as their

    | validation and creation. By default this controller uses a trait to

    | provide this functionality without requiring any additional code.

    |

    */



    use RegistersUsers;



    /**

     * Where to redirect users after registration.

     *

     * @var string

     */

    protected $redirectTo = RouteServiceProvider::HOME;



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest');

    }



    /**

     * Get a validator for an incoming registration request.

     *

     * @param  array  $data

     * @return \Illuminate\Contracts\Validation\Validator

     */

    protected function validator(array $data)

    {











        



        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'username' => ['required', 'string',  'max:255', 'unique:users'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

    

    }



    private function captcha()

    {

 if(!isset($_POST['g-recaptcha-response'])) return false;
        if(!empty($_POST['g-recaptcha-response'])){

        //your site secret key

        $secret = env("RECAPTCHA_SECRET_KEY");

        //get verify response data

        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

        $responseData = json_decode($verifyResponse);
        
        Log::channel('recaptcha')->warning('Failed reCAPTCHA attempt', [

            'score' => $responseData->score ?? 'N/A',

            'action' => $responseData->action ?? 'N/A',

            'hostname' => $responseData->hostname ?? 'N/A',

            'timestamp' => now(),

        ]);


            

        if (!$responseData->success || $responseData->score < 0.5) {

        // Log failed attempt


        return false;

        }

    }

    return true;

    }



    /**

     * Create a new user instance after a valid registration.

     *

     * @param  array  $data

     * @return \App\Models\User

     */

    protected function create(array $data)

    {

        if (!$this->captcha()) return abort(422, "reCAPTCHA validation failed!");

        return User::create([

            'name' => $data['name'],

            'email' => $data['email'],

            'username' => $data['username'],

            'password' => Hash::make($data['password']),

        ]);

    }

}

