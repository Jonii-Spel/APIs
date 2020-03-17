<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //Comentar para forzar excepcion.

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try {

            $users = User::all();
            return response()->json(['status' => true, 'data' => $users, 'message' => ""], 202);
        } catch (   Throwable $th) {
            return response()->json(['status' => false, 'data' => '', 'message' => $th->getMessage()],404);
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return User::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
        
        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        
        return 204; 
    }
}
