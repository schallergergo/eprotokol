<?php



namespace App\Providers;



use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Gate;



class AuthServiceProvider extends ServiceProvider

{

    /**

     * The policy mappings for the application.

     *

     * @var array<class-string, class-string>

     */

    protected $policies = [

        'App\Models\Program'      => 'App\Policies\ProgramPolicy',

         'App\Models\Block'       => 'App\Policies\BlockPolicy',

         'App\Models\Result'      => 'App\Policies\ResultPolicy',

         'App\Models\Competition' => 'App\Policies\CompetitionPolicy',

         'App\Models\Official'    => 'App\Policies\OfficialPolicy',

         'App\Models\Start'       => 'App\Policies\StartPolicy',

         'App\Models\User'        => 'App\Policies\UserPolicy',

         'App\Models\Championship' => 'App\Policies\ChampionshipPolicy',

         'App\Models\JumpingRound' => 'App\Policies\JumpingRoundPolicy',

         'App\Models\Style'        => 'App\Policies\StylePolicy',

        'App\Models\Team'          => 'App\Policies\TeamPolicy',

         'App\Models\TeamMember'   => 'App\Policies\TeamMemberPolicy',

         'App\Models\EventingCross'   => 'App\Policies\EventingCrossPolicy',

    ];



    /**

     * Register any authentication / authorization services.

     *

     * @return void

     */

    public function boot()

    {

        $this->registerPolicies();



        //

    }

}

