<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Season;

class SeasonController extends Controller
{
 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $seasons = Season::all();
        return view('season.index')
        ->with('seasons',$seasons);
    }

     /**
     * Show the form for create new Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $season = Season::findOrFail($id);
    }

    /**
     * Action for save Season
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $id = $request['id_season'];
            if($id == NULL){
                $season = new Season();
    	        $season->clave = $request['clave'];
                $season->description = $request['description'];
    	        $season->time_initial = $request['time_initial'];
    	        $season->time_end = $request['time_end'];
    	        $season->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $season = Season::findOrFail($id);
    			$season->clave = $request['clave'];
                $season->description = $request['description'];
    	        $season->time_initial = $request['time_initial'];
    	        $season->time_end = $request['time_end'];
    	        $season->estatus = ($request['estatus'] == "on")?1:0; 
                $message = "Registro Actualizado";    
            }
            $season->save();
            if($request['id_season_redirect'] == 'true'){
                return redirect('/seasons')->with('success', $message);
            }else{
                return Season::all()->where('estatus',1);
            }
         }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/seasons')->with('error', $message);
       }
    }

    /**
     * Action for delete Season
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $season = Season::findOrFail($id);
            $season->delete();
            return redirect('/seasons')->with('success', 'Registro Borrado');
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/seasons')->with('error', $message);
       }
    }

         /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $season = Season::where($request['column'], 'like', $request['val'])
            ->where('id_season', '!=', $request['id'])->get();
        }else{
            $season = Season::where($request['column'], 'like', $request['val'])->get();
        }

        return $season;
    }
}


