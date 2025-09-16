<?php

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BroadcastController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrintController;

use App\Http\Controllers\ProgramController;

use App\Http\Controllers\BlockController;

use App\Http\Controllers\ResultController;

use App\Http\Controllers\ResultPhotoController;

use App\Http\Controllers\ResultlogController;

use App\Http\Controllers\EventController;

use App\Http\Controllers\StartlistController;

use App\Http\Controllers\PhantomEventController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\StartController;

use App\Http\Controllers\CompetitionController;

use App\Http\Controllers\CompetitionStatsController;
use App\Http\Controllers\CompetitionImportController;

use App\Http\Controllers\ChampionshipController;

use App\Http\Controllers\OfficialController;

use App\Http\Controllers\SponsorController;

use App\Http\Controllers\SearchController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\DisplayController;

use App\Http\Controllers\UsageLogController;


use App\Http\Controllers\SiteMapController;

use App\Http\Controllers\QualificationController;
use App\Http\Controllers\JumpingQualificationController;
use App\Http\Controllers\JumpingRoundController;

use App\Http\Controllers\TeamController;

use App\Http\Controllers\TeamMemberController;

use App\Http\Controllers\StyleController;



use App\Http\Controllers\api\ApiContoller;

use App\Http\Controllers\AJAX\StartDataController;



use App\Http\Controllers\Finance\TransactionController;

use App\Http\Controllers\Finance\FinanceController;

use App\Http\Controllers\Finance\BoxFeeController;



use App\Http\Controllers\Eventing\EventingCrossController;

use App\Http\Controllers\Eventing\EventingShowJumpingController;



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



Route::get("/finance/show/{competition}", [FinanceController::class, 'show'])->name("finance.show");

Route::get("/finance/export/{competition}", [FinanceController::class, 'export'])->name("finance.export");



Route::get("/finance/filter/competition/{competition}/filter/{club}", [FinanceController::class, 'filterByClub'])->name("finance.filter.club");

Route::get("/finance/filter/competition/{competition}/rider/{rider_id}", [FinanceController::class, 'filterByRider'])->name("finance.filter.rider");

Route::get("/finance/didnotpay/competition/{competition}", [FinanceController::class, 'didNotPay'])->name("finance.didnotpay");









Route::get("/transaction/index/{competition}", [TransactionController::class, 'index'])->name("transaction.index");

Route::get("/transaction/show/{transaction}", [TransactionController::class, 'show'])->name("transaction.show");

Route::post("/transaction/create/{competition}", [TransactionController::class, 'transactionCreate'])->name("transaction.create");





Route::get("/boxfee/index/{competition}", [BoxFeeController::class, 'index'])->name("boxfee.index");

Route::get("/boxfee/create/{competition}", [BoxFeeController::class, 'create'])->name("boxfee.create");

Route::post("/boxfee/store/{competition}", [BoxFeeController::class, 'store'])->name("boxfee.store");

Route::post("/boxfee/import/{competition}", [BoxFeeController::class, 'import'])->name("boxfee.import");







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

Route::get('/start/index/rider/{rider_id}', [StartController::class,'riderIndex']);

Route::post('/start/store/{event}', [StartController::class,'store']);

Route::get('/start/edit/{start}', [StartController::class,'edit']);

Route::get('/start/compare/{start}', [StartController::class,'compare']);

Route::patch('/start/update/{start}', [StartController::class,'update']); 

Route::post('/start/import/{event}', [StartController::class,'import']);

Route::get('/start/delete/{start}', [StartController::class,'destroy'])->name("start.delete");



Route::get('/start/restore/{start}', [StartController::class,'restore']);

Route::get('/start/notStarted/{start}', [StartController::class,'notStarted'])->name("start.notStarted");



Route::get('/start/moveUp/{start}', [StartController::class,'moveUp']);

Route::get('/start/moveDown/{start}', [StartController::class,'moveDown']);



Route::get('/ajax/getRiderData', [StartDataController::class,'getRiderData'])->name("ajax.riderData");
Route::get('/ajax/getRiderAndHorseData', [StartDataController::class,'getRiderAndHorseData'])->name("ajax.riderAndHorseData");

Route::get('/ajax/getHorseData/{club}', [StartDataController::class,'getHorseData'])->name("ajax.horseData");



Route::get('/user/index', [UserController::class,'index']);

Route::get('/user/create', [UserController::class,'create']);

Route::post('/user/store', [UserController::class,'store']);

Route::get('/user/profile', [UserController::class,'profile']);

Route::get('/user/edit/{user}', [UserController::class,'editAsAdmin']);

Route::patch('/user/update/{user}', [UserController::class,'update']);

Route::patch('/user/updateAsAdmin/{user}', [UserController::class,'updateAsAdmin']);

Route::get('/user/search', [UserController::class,'search']);

Route::get('/user/delete/{user}', [UserController::class,'destroy']);




Route::get('/result/show/{result}', [ResultController::class, 'show']);



Route::post('/result/store', [ResultController::class, 'store']);

Route::get('/result/edit/{result}', [ResultController::class, 'edit']);

Route::get('/result/search', [SearchController::class, 'show']);

Route::get('/result/mail', [ResultController::class, 'mail']);

Route::get('/resultphoto/edit/result/{result}', [ResultPhotoController::class, 'edit']);

Route::patch('/resultphoto/updateResult/result/{result}', [ResultPhotoController::class, 'updateResult']);

Route::post('/resultphoto/storePhoto/result/{result}', [ResultPhotoController::class, 'storePhoto']);

Route::get('/resultphoto/{result_photo}/delete', [ResultPhotoController::class, 'destroy']);

Route::patch('/result/update/{result}', [ResultController::class, 'update']);

Route::post('/result/ajaxUpdate/{result}', [ResultController::class, 'ajaxUpdate']);



Route::get('/resultlog/index/{result}', [ResultlogController::class, 'index']);

Route::get('/resultlog/show/{resultlog}', [ResultlogController::class, 'show']);





Route::get('/event/show/{event}', [EventController::class, 'show']);

Route::get('/event/startlist/{event}', [EventController::class, 'startlist']);

Route::get('/event/create/{competition}', [EventController::class, 'create']);

Route::post('/event/store/{competition}', [EventController::class, 'store']);

Route::get('/event/edit/{event}', [EventController::class, 'edit']);

Route::get('/event/sort/{event}', [EventController::class, 'sort']);

Route::post('/event/saveorder/{event}', [EventController::class, 'saveOrder'])->name("event.saveOrder");

Route::get('/event/delete/{event}', [EventController::class, 'destroy']);

Route::patch('/event/update/{event}', [EventController::class, 'update']);

Route::patch('/event/updateStartlist/{event}', [EventController::class, 'updateStartlist']);

Route::get('/event/status/{event}', [EventController::class, 'changeStatus']);

Route::get('/event/export/{event}', [EventController::class, 'exportEvent']);

Route::get('/event/exportByKondor/{event}', [EventController::class, 'exportEventByKondor']);



Route::get('/event/deletedStarts/{event}', [EventController::class, 'deletedStarts']);



Route::post('/event/updateCategory/{event}', [EventController::class, 'updateCategory']);

Route::get('/event/resetCategory/{event}', [EventController::class, 'resetCategory']);

Route::get('/event/resetSponsor/{event}', [EventController::class, 'resetSponsor']);

Route::get('/event/secondStart/{event}', [EventController::class, 'updateSecondStart']);


Route::get('/event/copy/from/{fromEvent}/to/{toEvent}', [EventController::class, 'copyEvent']);



Route::get('/event/copycategory/from/{fromEvent}/to/{toEvent}', [EventController::class, 'copyCategory']);



Route::get('/event/phantom/{event}', [PhantomEventController::class, 'show']);

Route::get('/event/{event}/startlist/regenerate', [StartlistController::class, 'regenerate'])->name("startlist.regenerate");




Route::get('/competition/stats/{competition}', [CompetitionStatsController::class, 'show']);
Route::get('/competition/stats/{competition}/horses', [CompetitionStatsController::class, 'showHorseStartNumber']);
Route::get('/competition/stats/{competition}/horse/{horse}', [CompetitionStatsController::class, 'showHorseStarts'])->name('competition.stats.horse');



Route::get('/competition/stats/{competition}/riders', [CompetitionStatsController::class, 'showRiderStartNumber']);
Route::get('/competition/stats/{competition}/rider/{rider}', [CompetitionStatsController::class, 'showRiderStarts'])->name('competition.stats.rider');

Route::get('/competition/import/{competition}', [CompetitionImportController::class, 'import'])->name('competition.import');


Route::post('/competition/saveImport/{competition}', [CompetitionImportController::class, 'saveImport'])->name('competition.saveImport');

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

Route::get('/competition/sort/{competition}', [CompetitionController::class, 'sort']);

Route::post('/competition/saveOrder/{competition}', [CompetitionController::class, 'saveOrder'])->name("competition.saveOrder");



Route::get('/championship/index', [ChampionshipController::class, 'index']);

Route::get('/championship/show/{championship}', [ChampionshipController::class, 'show']);

Route::get('/championship/create', [ChampionshipController::class, 'create']);

Route::post('/championship/store', [ChampionshipController::class, 'store']);

Route::get('/championship/edit/{championship}', [ChampionshipController::class, 'edit']);

Route::patch('/championship/update/{championship}', [ChampionshipController::class, 'update']);

Route::get('/championship/delete/{championship}', [ChampionshipController::class, 'destroy']);

Route::get('/championship/changestatus/{championship}', [ChampionshipController::class, 'changeStatus']);

Route::post('/championship/addEvent/{championship}', [ChampionshipController::class, 'addEvent']);

Route::post('/championship/removeEvent/{championship}', [ChampionshipController::class, 'removeEvent']);





Route::get("/qualification/settings/{discipline}",[QualificationController::class,"qualificationSettings"])->name("qualification.settings");

Route::get("/qualification/show",[QualificationController::class,"qualificationShow"]);

Route::get("/qualification/download",[QualificationController::class,"qualificationDownload"]);

Route::get("/jumpingqualification/show",[JumpingQualificationController::class,"qualificationShow"]);
Route::get("/jumpingqualification/excel",[JumpingQualificationController::class,"qualificationExcel"]);


Route::get('/usagelog/index', [UsageLogController::class, 'index'])->name('usagelog.index');


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
Route::get('/broadcastCompetition/{competition}',[BroadcastController::class, 'broadcastCompetition']);
Route::get('/broadcastCompetition/{competition}',[BroadcastController::class, 'broadcastCompetition']);
Route::get('/broadcast/{event}/json',[BroadcastController::class, 'json']);

Route::get('/broadcast/sponsors/{competition}/json',[BroadcastController::class, 'getCompetitonSponsors']); 
Route::get('/broadcast/competition/{competition}/json',[BroadcastController::class, 'jsonCompetition']);

Route::get('/broadcast/{event}/serialized',[BroadcastController::class, 'serialized']);



Route::get('/team/index/{championship}',[TeamController::class, 'index']);

Route::get('/team/create/{championship}',[TeamController::class, 'create']);

Route::post('/team/store/{championship}',[TeamController::class, 'store']);

Route::get('/team/edit/{team}',[TeamController::class, 'edit']);

Route::post('/team/update/{team}',[TeamController::class, 'update']);

Route::get('/team/delete/{team}',[TeamController::class, 'destroy']);





Route::get('/team_member/create/{team}',[TeamMemberController::class, 'create']);

Route::post('/team_member/store/{team}',[TeamMemberController::class, 'store']);



Route::get('/team_member/delete/{team_member}',[TeamMemberController::class, 'destroy']);



Route::get('/display/settings/{event}',[DisplayController::class, 'settings']);

Route::get('/display/{event}',[DisplayController::class, 'display']);

Route::get('/display/vilagos/{competition}',[DisplayController::class, 'vilagos']);

Route::get('/display/tatter/{competition}',[DisplayController::class, 'tatter']);

Route::get('/display/compsetting/{competition}',[DisplayController::class, 'compsetting']);

Route::post('/display/storecompsetting/{competition}',[DisplayController::class, 'storeCompsetting']);







Route::get('/jumpinground/edit/{jumping_round}', [JumpingRoundController::class, 'edit']);

Route::patch('/jumpinground/update/{jumping_round}', [JumpingRoundController::class, 'update']);

Route::patch('/jumpinground/update2/{jumping_round}', [JumpingRoundController::class, 'update2']);







Route::get('/style/edit/{style}', [StyleController::class, 'edit']);

Route::patch('/style/update/{style}', [StyleController::class, 'update']);




Route::get('/eventing/cross/edit/{eventingCross}', [EventingCrossController::class, 'edit']);
Route::patch('/eventing/cross/update/{eventingCross}', [EventingCrossController::class, 'update']);

Route::get('/eventing/showjumping/edit/{eventingShowJumping}', [EventingShowJumpingController::class, 'edit']);
Route::patch('/eventing/showjumping/update/{eventingShowJumping}', [EventingShowJumpingController::class, 'update']);



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

Route::get('/event/{event}/printstartlist', [PrintController::class,'print']);

//API routes



Route::get('/api/user/{user}', [ApiController::class,'user']);