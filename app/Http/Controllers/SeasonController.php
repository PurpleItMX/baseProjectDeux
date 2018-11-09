<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('season.index')->with('seasons',$seasons);
    }

     /**
     * Show the form for create new Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('season.form')
        ->with('season','');
    }

    /**
     * Show the form for edit Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $season = Season::findOrFail($id);
        return view('season.form')
        ->with('season',$season);
    }

    /**
     * Action for save Season
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $id = $request['id_season'];
        if($id == NULL){
            $season = new Season();
	        $season->clave = $request['clave'];
	        $season->time_initial = $request['time_initial'];
	        $season->time_end = $request['time_end'];
	        $season->estatus = ($request['estatus'] == "on")?1:0;
        }else{
            $season = Season::findOrFail($id);
			$season->clave = $request['clave'];
	        $season->time_initial = $request['time_initial'];
	        $season->time_end = $request['time_end'];
	        $season->estatus = ($request['estatus'] == "on")?1:0;     
        }
        $season->save();
        return redirect()->action('SeasonController@index');
    }

    /**
     * Action for delete Season
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	Season::deleteById($id);
        return redirect()->action('SeasonController@index');
    }
}


