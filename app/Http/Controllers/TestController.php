<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    //
    public function test(){

        // return view('test');
    
        $routes = Route::getRoutes();
        $middleeareGroup = 'isAuthenticated';

        // dd($getRoute);
        $routeDetails = [];

        foreach($routes as $route){
            $middleeares = $route->gatherMiddleware();
            if(in_array($middleeareGroup, $middleeares)){
                $routeName = $route->getName();

                if($routeName != '/' && $routeName != 'logout'){
                    $routeDetails[] = [
                        'name' => $route->getName(),
                        'uri' => $route->uri()
                    ];
                }
                
            }
        }

        dd($routeDetails);

        return view('test', compact('routeDetails'));
    }
}
