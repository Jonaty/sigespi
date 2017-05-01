<?php

namespace sigespi\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{
	function __construct()
	{
		return $this->middleware('auth');
	}
	
    public function index()
    {
    	return view('tutor.index');
    }
}
