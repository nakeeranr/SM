<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserInterface;

class SessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $user;

    public function __construct(UserInterface $user){
     $this->user=$user;
    }

    public function handle($request, Closure $next)
    {
        $loggedInUserRole=!empty($request->user()->roles[0])?$request->user()->roles[0]:'';
        $roleName=isset($loggedInUserRole->slug_name)?$loggedInUserRole->slug_name:'';
        $relation = config('constants.ROLE_PROFILE.' . $roleName . '.userRelation');
        $orgID=isset($request->user()->$relation->organization)?$request->user()->$relation->organization->id:'';
        $request->merge(['sessionOrgID'=>$orgID]);
        View::share('sessionData',[
            'id'=>Auth::id(),
            'userRole'=>isset($loggedInUserRole->name)?$loggedInUserRole->name:'',
            'userName'=>$this->user->getUserFullName($request->user(), $relation),
            'userOrgName'=>isset($request->user()->$relation->organization)?$request->user()->$relation->organization->name:''
            ]);
        return $next($request);
    }
}
