<?php

namespace sigespi\Http\Controllers;

use Illuminate\Http\Request;

use sigespi\Http\Requests\LoginAdminRequest;

use sigespi\User;

use sigespi\Campus;

use sigespi\Plantel;

use sigespi\Carrera;

use sigespi\Ciclo;

use Auth;

use DB;

use Alert;

class AdminController extends Controller
{
    //Restriccion de las paginas del administrador, excepto el login y datos del login!!!!!!!!!!
	function __construct()
	{
		return $this->middleware('auth', ['except' => ['login', 'datosLoginAdmin']]);
	}
	public function home()
	{
		return view('admin.home');
	}

    public function login()
    {
    	return view('admin.login');
    }

    public function datosLoginAdmin(LoginAdminRequest $request)
    {
    	$no_docente = $request->input('no_docente');
    	$password = $request->input('password');

    	if (!Auth::attempt(['no_docente' => $no_docente, 'password' => $password, 'activo' => 1, 'rol' => 0, 'c_carr' => 'Z'])) 
    	{
    		return redirect()->back()->with('info', 'Datos Incorrectos');
    	}
    	else
    	{
    		return redirect()->route('homeAdmin')->with('info', 'Bienvenido Administrador');
    	}
    }

    public function salir()
    {
    	Auth::logout();

    	return redirect()->route('loginAdmin');
    }


    //Paginas del Administrador!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

   //Envia a la pagina para validar usuarios(Validar al Coordinador academico), y pasa todos los usuarios desde la BD!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function validarCoordinador()
    {
    	$docentes = User::all();
        $coordinador = User::where('rol', '=', 1)->first();

    	return view('admin.paginas.validarCoordinador', compact('docentes', 'coordinador'));
    }

//Datos del formulario para activar a los usuarios(coordinador academico), se pasa como parametro el id del usuario!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     public function formValidarCoordinador(Request $request, $id)
        {
          DB::table('users')->where('id', $id)->update([
            'activo' => $request->input('activo'),
            ]);
          
          Alert::success('El usuario ha sido activado', 'Usuario Activado');
          return redirect()->route('validarCoordinador');
        
        }
//Datos del formulario para dar de alta como Coordinador Academico a un usuario, se pasa como parametro el id del usuario!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      public function datosCambiarRoles(Request $request, $id)
        {
            $roles = implode(',', $request->input('rol'));

            DB::table('users')->where('id', $id)->update(['rol' => $roles]);
            
            Alert::success('El usuario ha sido dada de alta como Coordinador Académico', 'Coordinador Académico asignado');
            return redirect()->route('validarCoordinador');

        }
//Envia a la pagina para quitar y reasignar a el coordinador academico y se pasan todos los usuarios desde la BD!!!!!!!!!!!!!!!
        public function reasignarCoordinador()
        {
            $docentes = User::all();

            //$coordinador = User::where('rol', 1)->first();

            return view('admin.paginas.reasignarCoordinador', compact('docentes'));
        }

//Datos del formulario para quitar al coordinador academico, se pasa como parametro el id del usuario!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        public function quitarCoordinadorForm(Request $request, $id)
        {
           $roles = implode(',', $request->input('rol'));
           DB::table('users')->where('id', $id)->update(['rol' => $roles]);

           return redirect()->route('reasignarCoordinador');
        }
//Datos del formulario para reasignar a otro coordinador academico!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        public function reasignarCoordinadorForm(Request $request, $id)
        {
            $roles = implode(',', $request->input('rol'));
            DB::table('users')->where('id', $id)->update(['rol' => $roles]);

            return redirect()->route('reasignarCoordinador');
        }

        //Dada de alta a los campus de la universidad

        public function altaCampus()
        {
            return view('admin.paginas.altaCampus');
        }

        public function listaCampus()
        {
            $campus = Campus::all();

            return view('admin.paginas.listaCampus', compact('campus'));
        }

        public function altaCampusForm(Request $request)
        {
            $this->validate($request,
                [
                'nom_campus' => 'required',
                'delegacion' => 'required',
                'nom_universidad' => 'required',
                ]);

            $nom_campus = strtoupper($request->input('nom_campus'));
            $delegacion = strtoupper($request->input('delegacion'));
            $nom_universidad = strtoupper($request->input('nom_universidad'));

            Campus::create(['nom_campus' => $nom_campus, 'delegacion' => $delegacion, 'nom_universidad' => $nom_universidad]);

            return redirect()->route('altaCampus')->with('info', 'El campus ha sido dado de alta exitosamente');
        }

        //Dada de alta de los planteles

        public function altaPlanteles()
        {
            $campus = Campus::all();

            return view('admin.paginas.altaPlanteles', compact('campus'));
        }

        public function altaPlantelesForm(Request $request)
        {
            $this->validate($request, [
                'nom_plantel' => 'required',
                'siglas' => 'required',
                'campus_id' => 'required'
                ]);

            $nom_plantel = strtoupper($request->input('nom_plantel'));
            $siglas = strtoupper($request->input('siglas'));
            $campus_id = $request->input('campus_id');

            Plantel::create(['nom_plantel' => $nom_plantel, 'siglas' => $siglas, 'campus_id' => $campus_id]);

            return redirect()->route('altaPlanteles')->with('info', 'El plantel ha sido dado de alta exitosamente');
        }

        //Dada de alta de las carreras!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        public function altaCarreras()
        {
            $planteles = Plantel::all();

            return view('admin.paginas.altaCarreras', compact('planteles'));
        }

        public function altaCarrerasForm(Request $request)
        {
            $this->validate($request, [
                 'nom_carrera' => 'required',
                 'siglas' => 'required',
                 'grupo' => 'required',
                 'plantel_id' => 'required'
                ]);
            
            $nom_carrera = strtoupper($request->input('nom_carrera'));
            $siglas = strtoupper($request->input('siglas'));
            $grupo = $request->input('grupo');
            $plantel_id = $request->input('plantel_id');

            Carrera::create(['nom_carrera' => $nom_carrera, 'siglas' => $siglas, 'grupo' => $grupo, 'plantel_id' => $plantel_id]);

            return redirect()->route('altaCarrerasForm')->with('info', 'Carrera creada exitosamente');
        }
     //Dada de alta de los ciclos escolares!!!!!!!!!!!!!!!!!!!!!!!!!
        public function altaCiclos()
        {
            return view('admin.paginas.altaCiclos');
        }

        public function altaCiclosForm(Request $request)
        {
            //dd($request->all());

            Ciclo::create($request->all());

            return redirect()->route('altaCiclos')->with('info', 'Ciclo creado!');
        }
}




