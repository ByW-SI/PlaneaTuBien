<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ClienteLoginController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('guest:cliente',['except'=>['logout','loggedOut']]);
    }


    public function showLoginForm()
    {
    	return  view('auth.cliente-login');
    }

    public function login(Request $request)
    {
    	// validar los datos del formulario
    	$this->validate($request,[
    		"email"=>'required|email',
    		"password"=>'required|min:6'
    	]);
    	// Checar si el cliente ya esta registrado
    	if(Auth::guard('cliente')->attempt(['email'=>$request->email,'password'=>$request->password])){
    		// si es correcto, entonces redirigimos a su pagina de clientes
    		return redirect()->intended(route('cliente.dashboard'));
    	}
    	else{
    		// Si es incorrecto, redirigimos atras al login de usuario
    		return redirect()->back()->withInput($request->only('email','remember'));
    	}

    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/clientes/login');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

}
