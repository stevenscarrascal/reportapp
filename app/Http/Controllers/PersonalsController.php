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
        $this->middleware('can:coordinador');
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
        $tipodocumento = vs_tipo_documento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = null;
        return view('personals.create', compact('tipodocumento', 'roles','userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validación de datos
        $request->validate(personals::$rules);
        // Validar existencia de personal por número de documento
        $userCorreo = $request['correo'];
        $userRol = $request['rol'];

        $existingPersonal = personals::where('numero_documento', $request->input('numero_documento'))->first();
        if ($existingPersonal) {
        
            // Si ya existe personal con ese número de documento, muestra un mensaje de error y redirige
            return redirect()->back()->with('success', 'Ya existe un personal con este número de documento.')->with('title', 'Error');
        }
        // Si no existe, crea el personal
        $data = $request->all();
        $personal = personals::create($data);
        $personal_id = $personal->id;

        // Crear usuario
        $user = new User([
            'email' => $userCorreo,
            'password' => bcrypt($request['numero_documento']),
        ]);

        // Asignar roles al usuario
        $Role = Role::where('name', $userRol)->first();
        $user->assignRole($Role);

        // Asociar usuario al personal creado
        $user->personal_id = $personal_id; //
        $user->save();

        
        return  redirect()->route('personals.index')->with('icon', 'error')->with('success', 'Personal Creado con Exito')
        ->with('title', 'Guardado');
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
    public function edit(string $id, User $user)
    {
        $personal = personals::find($id);

        // Verificar si el registro "personals" existe
        if (!$personal) {
            // Redirige a una página de error o a otra página si el registro "personals" no se encuentra
            
            return redirect()->back()->with('success', 'Registro no Encontrado')->with('title', 'Error');
        }

        // Buscar el registro de usuario asociado con el registro personal
        $roles = Role::pluck('name', 'name')->all();

        $user = User::where('personal_id', $personal->id)->first();
        // Verificar si el registro de usuario existe
        $userRoles = $user->roles->pluck('name')->toArray();

        // Verificar si el registro de usuario existe
        $tipodocumento = vs_tipo_documento::pluck('nombre', 'id');
        return view('personals.edit', compact('personal', 'tipodocumento', 'roles', 'user', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $personal = personals::find($id);

        if ($personal) {
            $personal->update($request->all());
            notify()->success('Personal actualizado con éxito');
        } else {
            notify()->error('No se encontró el registro personal');
        }

        return redirect()->route('personals.index');
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
