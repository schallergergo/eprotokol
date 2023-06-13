<?php
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ResultlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhantomEventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\api\ApiContoller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Auth::routes();
$user=Auth::User();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')->middleware('verified');

Route::get("/admin/login/{userId}", [App\Http\Controllers\AdminController::class, 'loginAsUser']);
Route::get("/admin/logbackin", [App\Http\Controllers\AdminController::class, 'loginBackInAsAdmin']);

Route::get("/admin/notregistered", [App\Http\Controllers\AdminController::class, 'notRegistered']);

Route::get('/contact', [ContactController::class,'create']);
Route::post('/contact/send', [ContactController::class,'store']);

Route::get('/program/index', [ProgramController::class,'index']);
Route::get('/program/show/{program}', [ProgramController::class,'show']);
Route::get('/program/create', [ProgramController::class,'create']);
Route::post('/program/store', [ProgramController::class,'store']);
Route::get('/program/edit/{program}', [ProgramController::class,'edit']);
Route::patch('/program/update/{program}', [ProgramController::class,'update']);

Route::get('/block/create/{program}', [BlockController::class,'create']);
Route::post('/block/store/{program}', [BlockController::class,'store']);
Route::get('/block/edit/{block}', [BlockController::class,'edit']);
Route::patch('/block/update/{block}', [BlockController::class,'update']);
Route::get('/block/delete/{block}', [BlockController::class,'destroy']);

Route::get('/start/create/{event}', [StartController::class,'create']);
Route::get('/start/index/{user}', [StartController::class,'index']);
Route::post('/start/store/{event}', [StartController::class,'store']);
Route::get('/start/edit/{start}', [StartController::class,'edit']);
Route::patch('/start/update/{start}', [StartController::class,'update']); 
Route::post('/start/import/{event}', [StartController::class,'import']);
Route::get('/start/delete/{start}', [StartController::class,'destroy']);

Route::get('/start/moveUp/{start}', [StartController::class,'moveUp']);
Route::get('/start/moveDown/{start}', [StartController::class,'moveDown']);


Route::get('/user/index', [UserController::class,'index']);
Route::get('/user/create', [UserController::class,'create']);
Route::post('/user/store', [UserController::class,'store']);
Route::get('/user/profile', [UserController::class,'profile']);
Route::get('/user/edit/{user}', [UserController::class,'editAsAdmin']);
Route::patch('/user/update/{user}', [UserController::class,'update']);
Route::patch('/user/updateAsAdmin/{user}', [UserController::class,'updateAsAdmin']);


Route::get('/result/show/{result}', [ResultController::class, 'show']);

Route::post('/result/store', [ResultController::class, 'store']);
Route::get('/result/edit/{result}', [ResultController::class, 'edit']);
Route::get('/result/search', [SearchController::class, 'show']);
Route::get('/result/mail', [ResultController::class, 'mail']);

Route::patch('/result/update/{result}', [ResultController::class, 'update']);
Route::post('/result/ajaxUpdate/{result}', [ResultController::class, 'ajaxUpdate']);

Route::get('/resultlog/index/{result}', [ResultlogController::class, 'index']);
Route::get('/resultlog/show/{resultlog}', [ResultlogController::class, 'show']);


Route::get('/event/show/{event}', [EventController::class, 'show']);
Route::get('/event/startlist/{event}', [EventController::class, 'startlist']);
Route::get('/event/create/{competition}', [EventController::class, 'create']);
Route::post('/event/store/{competition}', [EventController::class, 'store']);
Route::get('/event/edit/{event}', [EventController::class, 'edit']);
Route::get('/event/delete/{event}', [EventController::class, 'destroy']);
Route::patch('/event/update/{event}', [EventController::class, 'update']);
Route::get('/event/status/{event}', [EventController::class, 'changeStatus']);
Route::get('/event/export/{event}', [EventController::class, 'exportEvent']);

Route::post('/event/updateCategory/{event}', [EventController::class, 'updateCategory']);
Route::get('/event/resetCategory/{event}', [EventController::class, 'resetCategory']);
Route::get('/event/resetSponsor/{event}', [EventController::class, 'resetSponsor']);


Route::get('/event/phantom/{event}', [PhantomEventController::class, 'show']);


Route::get('/competition/index', [CompetitionController::class, 'index']);

Route::get('/competition/show/{competition}', [CompetitionController::class, 'show']);
Route::get('/competition/create', [CompetitionController::class, 'create']);
Route::post('/competition/store', [CompetitionController::class, 'store']);
Route::get('/competition/edit/{competition}', [CompetitionController::class, 'edit']);
Route::patch('/competition/update/{competition}', [CompetitionController::class, 'update']);
Route::get('/competition/updateActive/{competition}', [CompetitionController::class, 'updateActive']);
Route::get('/competition/delete/{competition}', [CompetitionController::class, 'destroy']);
Route::get('/competition/getEvents/{competition}', [CompetitionController::class, 'getEvents']);
Route::get('/competition/activeEvents/{competition}', [CompetitionController::class, 'activeEvents']);


Route::get('/championship/index', [ChampionshipController::class, 'index']);
Route::get('/championship/show/{championship}', [ChampionshipController::class, 'show']);
Route::get('/championship/create', [ChampionshipController::class, 'create']);
Route::post('/championship/store', [ChampionshipController::class, 'store']);
Route::get('/championship/edit/{championship}', [ChampionshipController::class, 'edit']);
Route::patch('/championship/update/{championship}', [ChampionshipController::class, 'update']);
Route::get('/championship/delete/{championship}', [ChampionshipController::class, 'destroy']);
Route::post('/championship/addEvent/{championship}', [ChampionshipController::class, 'addEvent']);
Route::post('/championship/removeEvent/{championship}', [ChampionshipController::class, 'removeEvent']);


Route::get("/qualification/settings/{discipline}",[StartController::class,"qualificationSettings"]);
Route::post("/qualification/show",[StartController::class,"qualificationShow"]);



Route::get('/official/create/{event}', [OfficialController::class, 'create']);
Route::post('/official/store/{event}', [OfficialController::class, 'store']);
Route::get('/official/edit/{official}', [OfficialController::class, 'edit']);
Route::patch('/official/update/{official}', [OfficialController::class, 'update']);
Route::get('/official/delete/{official}', [OfficialController::class, 'destroy']);


Route::get('/sponsor/index', [SponsorController::class, 'index']);
Route::get('/sponsor/create', [SponsorController::class, 'create']);
Route::post('/sponsor/store', [SponsorController::class, 'store']);
Route::get('/sponsor/delete/{sponsor}', [SponsorController::class, 'destroy']);


Route::get('/broadcast/{event}',[BroadcastController::class, 'broadcast']);
Route::get('/broadcast/{event}/json',[BroadcastController::class, 'json']);
Route::get('/broadcast/{event}/serialized',[BroadcastController::class, 'serialized']);



Route::get('/display/settings/{event}',[DisplayController::class, 'settings']);
Route::get('/display/{event}',[DisplayController::class, 'display']);
Route::get('/display/vilagos/{competition}',[DisplayController::class, 'vilagos']);
Route::get('/display/tatter/{competition}',[DisplayController::class, 'tatter']);
Route::get('/display/compsetting/{competition}',[DisplayController::class, 'compsetting']);
Route::post('/display/storecompsetting/{competition}',[DisplayController::class, 'storeCompsetting']);



Route::get('/sitemap.xml',[SiteMapController::class, 'generate']);


Route::get('/caprilli',[ResultController::class, 'caprilli']);

Route::get("/faq", function(){ return view("faq"); });


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/mail', function () {
    $result = App\Models\Result::find(1);

    return new App\Mail\NewResultMail($result);
});


Route::get('/lang/{locale}',function($locale){
    if (! in_array($locale, ['en', 'hu'])) {
        abort(403);
    }
    app()->setLocale($locale);
    session()->put('locale', $locale);

       return redirect()->back();   
});

//API routes

Route::get('/api/user/{user}', [ApiController::class,'user']);