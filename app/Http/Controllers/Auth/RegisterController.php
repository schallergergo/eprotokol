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
    if (!isset($_POST['g-recaptcha-response'])) {
        Log::channel('recaptcha')->warning('Failed reCAPTCHA attempt');
        return false;
    }

    if (!empty($_POST['g-recaptcha-response'])) {
        $secret = env("RECAPTCHA_SECRET_KEY");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => $secret,
            'response' => $_POST['g-recaptcha-response'],
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // ensures SSL check
        $verifyResponse = curl_exec($ch);
        curl_close($ch);

        if ($verifyResponse === false) {
            Log::channel('recaptcha')->error('cURL failed contacting reCAPTCHA API');
            return false;
        }

        $responseData = json_decode($verifyResponse);

        Log::channel('recaptcha')->warning('Failed reCAPTCHA attempt', [
            'score' => $responseData->score ?? 'N/A',
            'action' => $responseData->action ?? 'N/A',
            'hostname' => $responseData->hostname ?? 'N/A',
            'timestamp' => now(),
        ]);

        if (!$responseData->success || ($responseData->score ?? 0) < 0.5) {
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

