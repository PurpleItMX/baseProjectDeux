<?php
namespace App\Http\Controllers\WebServices;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadTableController extends Controller
{
    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param $table
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        return "no habilitada";
        
    }

    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function show($table)
    {
        $result = DB::select('select * from ' . $table);
        return json_encode($result);
    }


    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        return "no habilitada";
    }

    public function update(Request $request, $id)
    {
        return "no habilitada";
    }

    public function delete(Request $request, $id)
    {
        return "no habilitada";
    }
}