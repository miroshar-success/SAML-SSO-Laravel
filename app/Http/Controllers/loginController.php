<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Saml2;
use Session;

class loginController extends Controller
{
  public function ssologin(Request $request)
  {
    return Saml2::login();
  }

  public function ssologout(Request $request)
  {
    if( $request->session()->get('isFromOneLogin') )
      return Saml2::logout();
    else {
      return $this->logout($request);
    }
  }

  public function doLogin(Request $request)
  {
    $username = $request->request->get('uname');
    $request->session()->put('username', $username);
    $request->session()->put('isFromOneLogin', false);
    $session_username = $request->session()->get('username');

    return view('login', ['name' => $session_username]);
  }

  public function logout(Request $request)
  {
    $request->session()->forget('username');
    $request->session()->flush();
    return redirect('/login');
  }

}
