<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\ClienteCredential;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CredencialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Presolicitud $presolicitud)
    {
        // OBTENEMOS PASSWORD ALEATORIO
        $length = 10;    
        $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);

        // CREAMOS O ACTUALIZAMOS LAS CREDENCIALES DEL USUARIO
        $credencial = ClienteCredential::updateOrCreate(['presolicitud_id'=>$presolicitud->id],[
            'name' =>$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno,
            'email'=>$presolicitud->email,
            'password'=>Hash::make($password),
            'presolicitud_id'=>$presolicitud->id
        ]);


        // ENVIAMOS CORREO AL USUARIO SI LAS CREDENCIALES FUERON ENVIADAS
        if(!$credencial){
            return back();
        }
        $credencial->sendCredentialNotification($password);
        $presolicitud->prospecto=1;
        $presolicitud->save();
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto,Presolicitud $presolicitud,Request $request)
    {
        //
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cliente_credentials',
            'password' => 'required|string|min:6|confirmed'
        ];
        $this->validate($request, $rules);
        $credencial = new ClienteCredential([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $credencial->presolicitud_id = $presolicitud->id;
        $credencial->save();
        if ($credencial) {
            $credencial->sendCredentialNotification($request->password);
            
            return redirect()->route('prospectos.presolicitud.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        } else {
            
            return redirect()->route('prospectos.presolicitud.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClienteCredential  $credencial
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto,Presolicitud $presolicitud,ClienteCredential $credencial)
    {
        //
        // return view('prospectos.presolicitud.credential.show',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'credencial'=>$credencial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClienteCredential  $credencial
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto,Presolicitud  $presolicitud,ClienteCredential $credencial)
    {
        //
         return view('prospectos.presolicitud.credential.form',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'credencial'=>$credencial,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClienteCredential  $credencial
     * @return \Illuminate\Http\Response
     */
    public function update(Prospecto $prospecto,Presolicitud  $presolicitud,Request $request, ClienteCredential $credencial)
    {
        // VALIDAMOS LOS DATOS
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cliente_credentials,id,'.$credencial->id,
        ];
        $this->validate($request, $rules);

        // ACTUALIZAMOS LA CREDENCIAL DEL CLIENTE
        $credencial->update([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        // NOTIFICAMOS EN CASO DE QUE EXISTA LA CREDENCIAL
        if(!$credencial){
            return redirect()->route('prospectos.presolicitud.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
        $credencial->sendCredentialNotification($request->password);
        return redirect()->route('prospectos.presolicitud.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClienteCredential  $credencial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteCredential $credencial)
    {
        //
    }
}
