<?php

namespace sigespi\Http\Controllers;

use Illuminate\Http\Request;

use sigespi\User;

use DB;

class CoordinadorController extends Controller
{
	function __construct()
	{
		return $this->middleware('auth');
	}

    public function index()
    {
    	return view('coordinador.index');
    }

    public function validarAsignarUsuarios()
    {
    	$docentes = User::all();

    	return view('coordinador.validarAsignarUsuarios', compact('docentes'));
    }

    public function formvalidarAsignarUsuarios(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
        	'activo' => $request->input('activo')]);

        return redirect()->route('validarAsignarUsuarios')->with('info', 'Usuario Validado');
    }

    public function asignarCoordinadorCarrera($id)
    {
    	$docente = User::findOrFail($id);
    	return view('coordinador.asignarCoordinadorCarrera', compact('docente'));
    }

    public function formAsignarCoordinadorCarrera(Request $request, $id)
    {

    	/*$this->validate($request, [
            'c_carr' => 'required'
    		]);*/

    	$c_carr = $request->input('c_carr');

    	if ($c_carr == null) 
    	{
    		return redirect()->back()->with('info', 'Elige una carrera');
    	}

    	DB::table('users')->where('id', $id)->update(['c_carr' => $c_carr]);

    	return redirect()->route('validarAsignarUsuarios')->with('info2', 'Coordinador de Carrera Asignado');
    }
}