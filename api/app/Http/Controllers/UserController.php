<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; //Comentar para forzar excepcion.
use Illuminate\Support\Facades\Validator; //Sirve para la validacion
use Illuminate\Support\Facades\Hash; //Sirve para encriptar contrasenias

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
            return response()->json(['status' => true, 'data' => $users, 'message' => "Listado de Users"], 202);
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

        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }

        // Creamos las reglas de validación
        $rules = [
            'name'      => 'required|min:3',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6'
            ];
 
        try{
                // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
                // con los errores
                $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return [
                            'created' => false,
                            'errors'  => $validator->errors()->all()
                        ];
                    }
                // Si el validador pasa, almacenamos el usuario
                $users = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])]);

                return response()->json(['status' => true, 'data' => $users, 'message' => "Se ha creado con exito"], 200);  
            }

        catch (Exception $e)
        {
            // Si algo sale mal devolvemos un error.
            Log::info('Error creating user: '.$e);
            return Response::json(['created' => false], 500);
            return response()->json(['status' => false, 'data' => '', 'message' => $th->getMessage()],400);
        }
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

        try {

            $usuario = User::findOrFail($id);
            $usuario->update($request->all());
            $usuario->save();
            return response()->json(['status' => true, 'data' => $usuario, 'message' => "Se ha actualizado con exito"], 201);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => '', 'message' => $th->getMessage()],400);
        }

        // $users = User::where('id', $id)->first();
        // $users->update($request->all());
        // return response()->json($users, 200);
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['status' => true, 'data' => $user, 'message' => "Aqui esta el user solicitado"], 201);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => '', 'message' => $th->getMessage()],404);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::destroy($id);
            return response()->json(['status' => true, 'data' => $user, 'message' => "Se elimino correctamente"], 200);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => '', 'message' => $th->getMessage()],404);

        }
    }
}
