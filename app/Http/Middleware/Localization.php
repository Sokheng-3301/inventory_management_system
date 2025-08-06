<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        app()->setlocale(session('localization', config('app.locale')));
        // app()->setlocale($request -> segment(1));

        // URL::defaults(['locale' => $request->segment(1)]);
        // URL::defaults(['locale' => $request->user()->locale]);


        // dd(session());
        // if(session('localization') == 'kh'){
        //     dd('kh');
        // }else{
        //     dd('en');
        // }

        // dd("Check notification");
        $checkRquest = DB::table('borrows')
                        ->where('flash_notification', 1)
                        ->get();

        if($checkRquest == true){
            DB::table('borrows')
                    ->update(['flash_notification' => 0]);

            session(['flashNotification' => '1']);
        }else{
            session(['flashNotification' => '0']);
        }

        return $next($request);
    }
}
