<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Event;
//use App\Events\SamlLoginEvent;
//use Aacotroneo\Saml2\Events\Saml2LoginEvent;

//use App\User;
//use App\Auth;


class homeController extends Controller
{
  //protected $user;
  //protected $auth;
  public function home(Request $request)
  {
    //print_r($this->auth);



    //Event::fire(new Saml2LoginEvent($this->user,$this->auth));
    return view('welcome', []);
  }



}
