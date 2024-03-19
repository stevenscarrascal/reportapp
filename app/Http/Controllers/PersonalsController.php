<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\User;
use App\Models\vs_tipo_documento;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PersonalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:administrador,coordinador');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personals = personals::with('estado', 'tipodocumento')->get();
        $tipodocumento = vs_tipo_documento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'name')->all();
        return view('personals.index', compact('personals', 'tipodocumento', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate(personals::$rules);
        // Validar existencia de personal por número de documento
        $userCorreo = $request['correo'];
        $password = $request['password'];
        $userRol = $request['rol'];

        $existingPersonal = personals::where('numero_documento', $request->input('numero_documento'))->first();
        if ($existingPersonal) {
            notify()->error('Ya existe un Agente con este número de documento.');
            // Si ya existe personal con ese número de documento, muestra un mensaje de error y redirige
            return redirect()->back();
        }
        // Si no existe, crea el personal
        $data = $request->all();
        $personal = personals::create($data);
        $personal_id = $personal->id;

        // Crear usuario
        $user = new User([
            'email' => $userCorreo,
            'password' => bcrypt($password),
        ]);

        // Asignar roles al usuario
        $Role = Role::where('name', $userRol)->first();
        $user->assignRole($Role);

        // Asociar usuario al personal creado
        $user->personal_id = $personal_id; //
        $user->save();

        notify()->success('Personal creado con éxito');
        return  redirect()->route('personals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(personals $personals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personals $personals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personals $personals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Buscar el registro personal
       $personal = personals::find($id);



       // Verificar si el registro personal existe
       if (!$personal) {
           // Manejar el caso cuando el registro no se encuentra
           // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
           notify()->success('Registro personal no encontrado.');
           return redirect()->back();
       }

       // Buscar el registro de usuario asociado con el registro personal
       $usuario = User::where('personal_id', $personal->id)->first();


       // Verificar si el registro de usuario existe
       if (!$usuario) {
           // Manejar el caso cuando el registro no se encuentra
           // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
           notify()->success('Registro de usuario no encontrado.');
           return redirect()->back();
       }

       // Actualizar la propiedad estado para ambos registros
       $personal->estado = 4;
       $personal->update();

       $usuario->estado = 0;
       $usuario->update();

       // Notificar éxito
       notify()->success('Usuario eliminado con éxito');

       // Redirigir a la ruta de índice
       return redirect()->route('personals.index');
    }
}
