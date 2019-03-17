<?php

namespace App\Http\Controllers;

use App\Models\ClockType;
use Illuminate\Http\Request;


/**
 * Class ClockTypesController
 *
 * Controlador para acciones CRUD de Tipos de Registros de Tiempo.
 *
 * @package App\Http\Controllers
 */
class ClockTypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // @TODO crear un middleware para autenticar que tiene rol admin
        // $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = [
            'clockTypes' => ClockType::all(['id', 'name', 'description'])
        ];

        return view('admin.clocktypes.view', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clocktypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'clocktype_name'=>'required|max:15|unique:clock_types,name',
            'clocktype_description'=> 'present|max:120',
        ]);

        $clockTypeData = [
            'name' => $request->get('clocktype_name'),
            'description'=> $request->get('clocktype_description'),
        ];
        $clockType = new ClockType($clockTypeData);
        $clockType->save();

        $message = sprintf("Se ha creado el registro de tiempo de tipo '%s'", $clockTypeData['name']);

        return redirect(route('clocktypes.index'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
