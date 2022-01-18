<?php
namespace App\Http\Middleware;
use Closure;
class Localization
{
    protected $languages = ['en', 'hu'];
    public function handle($request, Closure $next)
    {
        if(session()->has('locale') && in_array(session()->get('locale'), $this->languages))
        {
            app()->setLocale(session()->get('locale'));
        }
        return $next($request);
    }

}