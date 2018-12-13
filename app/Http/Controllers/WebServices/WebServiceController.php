<?php
namespace App\Http\Controllers\WebServices;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebServiceController extends Controller
{
    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param $table
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //$result = DB::select('select * from products');
        //$result2 = DB::select('select * from sales');
        $result = DB::select('select * from detail_sales');

        return json_encode($result);
    }

    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return "show";
    }

    /**
    *Muestra la Consulta de la tabla selecccionada
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','256M');
        ini_set('post_max_size','256M');
        ini_set('upload_max_filesize','256M');
        ini_set('LimitRequestFieldSize', 0);
        try{

           $table = $request["table"];
           $company = $request["company"];
           $date_initial =  substr($request["date_initial"],8,2)."/".substr($request["date_initial"],5,2) ."/".substr($request["date_initial"],0,4);
           $date_end = substr($request["date_end"],8,2)."/".substr($request["date_end"],5,2) ."/".substr($request["date_end"],0,4);
           $objects = json_decode($request["objetos"]);
           if($date_end != NULL && $date_initial != NULL){
            //delete from detail_sales where company ='Company1' and date BETWEEN '24/07/2017 00:00:00' and '31/07/2017 23:59:59'
             DB::delete("delete from ".$table ." where company ='".$company."' and date BETWEEN '".$date_initial."00:00:00' and '".$date_end ."23:59:59'");
           }
            else{
                DB::delete("delete from ".$table ." where company ='".$company."'");
            }

           foreach ($objects as $key => $object) {
                $stringColumn = "";
                $stringValues = "";
                foreach ($object as $key => $value) {
                    if($stringColumn != ""){
                        $stringColumn.=",";
                    }
                    if($table == 'products'){
                        $stringColumn.= $this->getNameColumnProducts($key);
                    }elseif ($table == 'sales'){
                        $stringColumn.= $this->getNameColumnSales($key);
                    }elseif ($table == "detail_sales"){
                        $stringColumn.= $this->getNameColumnDetailSales($key);
                    }

                    if($stringValues != ""){
                        $stringValues.=",";
                    }
                    if($key == "EMPRESA"){
                        $stringValues.="'".$company."'";
                    }else{
                        $stringValues.="'".$value."'";    
                    }
                    
                } 
                //return 'insert into '.$table.' ('.$stringColumn.') values('.$stringValues.')';
                DB::insert('insert into '.$table.' ('.$stringColumn.') values('.$stringValues.')');
           }
           return "Los datos fueron publicados satisfactoriamente";
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        return $request;
    }

    public function delete(Request $request, $id)
    {
        return "delete";
    }

    protected function getNameColumnProducts($value){
        $columnName = array();
        $columnName["EMPRESA"] = "company";
        $columnName["CODIGO"] = "clave";
        $columnName["DESCRIPCION"] = "description";
        $columnName["IMPORTE"] = "price_sale";
        $columnName["IMPUESTOS"] = "import_iva";
        $columnName["PRECIO"] = "price_sale_iva";

        return $columnName[$value];
    }

    protected function getNameColumnSales($value){
        $columnName = array();

        $columnName["DATEID"] = "date";
        $columnName["SEMANA"] = "week";
        $columnName["MESA"] = "table";
        $columnName["AÑO"] = "year";
        $columnName["EMPRESA"] = "company";
        $columnName["MESERO"] = "waiter";
        $columnName["SECCION_RESTAURANTE"] = "section_restaurant";
        $columnName["TIPO_COMANDA"] = "command_type";
        $columnName["HORA"] = "time";
        $columnName["REGION"] = "region";
        $columnName["ZONA"] = "zone";
        $columnName["AGRUPADOR_HORARIO"] = "time_grouper";
        $columnName["NUM_SEMANA"] = "week_number";
        $columnName["DIA_SEMANA"] = "week_day";
        $columnName["NOMBRE_MES"] = "month_name";
        $columnName["TEMPORADA"] = "season";
        $columnName["TEMPORADA"] = "day_number";
        $columnName["TICKET"] = "ticket";
        $columnName["NUM_COMANDAS"] = "command_number";
        $columnName["NUM_TICKETS"] = "tickets_number";
        $columnName["NUM_MESAS"] = "tables_number";
        $columnName["COMENSALES"] = "diners";
        $columnName["PROPINAS"] = "tips";
        $columnName["DESCUENTOS"] = "total_sale";
        $columnName["VENTA_BRUTA"] = "discounts";
        $columnName["VENTA_BRUTA"] = "gross_sales";
        $columnName["IMPTOS"] = "taxes";
        $columnName["IMPTOS_DESC"] = "taxes_discounts";
        $columnName["IMPTOS_BRUTOS"] = "taxes_gross";
        $columnName["VENTA_NETA"] = "sales_net";
        $columnName["COSTO_VENTA"] = "cost_sales";

        return $columnName[$value];
    }

    protected function getNameColumnDetailSales($value){
        $columnName = array();

        $columnName["DATEID"] = "date";
        $columnName["SEMANA"] = "week";
        $columnName["MES"] = "month";
        $columnName["AÑO"] = "year";
        $columnName["DIA_SEMANA"] = "week_day";
        $columnName["NUM_SEMANA"] = "week_number";
        $columnName["NOMBRE_MES"] = "month_name";
        $columnName["NUM_DIA"] = "day_number";
        $columnName["TEMPORADA"] = "season";
        $columnName["EMPRESA"] = "company";
        $columnName["REGION"] = "region";
        $columnName["ZONA"] = "zone";
        $columnName["MESERO"] = "waiter";
        $columnName["SECCION_RESTAURANTE"] = "section_restaurant";
        $columnName["TIPO_COMANDA"] = "command_type";
        $columnName["HORA"] = "time";
        $columnName["AGRUPADOR_HORARIO"] = "time_grouper";
        $columnName["CLAVE_PRODUCTO"] = "clave_product";
        $columnName["PLATILLO"] = "dish";
        $columnName["GRUPO_DE_PLATILLO"] = "group_dish";
        $columnName["GRUPO_DE_MENU"] = "group_menu";
        $columnName["TIPO_DE_PLATILLO"] = "type_dish";
        $columnName["TICKET"] = "ticket";
        $columnName["ES_MODIFICADOR"] = "modified";
        $columnName["VENTA_TOTAL"] = "total_sale";
        $columnName["DESCUENTOS"] = "discounts";
        $columnName["VENTA_BRUTA"] = "gross_sales";
        $columnName["IMPTOS"] = "taxes";
        $columnName["IMPTOS_DESC"] = "taxes_discounts";
        $columnName["IMPTOS_BRUTOS"] = "taxes_gross";
        $columnName["VENTA_NETA"] = "sales_net";
        $columnName["COSTO_VENTA"] = "cost_sales";
        $columnName["UNIDAD_VENTA"] = "unity_sales";
        $columnName["UNIDAD_DEV"] = "back_sales";

        return $columnName[$value];
    }
}