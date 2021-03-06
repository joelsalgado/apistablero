<?php

namespace App\Http\Controllers;

use App\AdicionalesPrimaria;
use App\Adultos;
use App\AlumnosPres;
use App\AlumnosPrimaria;
use App\AlumnSecu;
use App\AlumPrim;
use App\ContactoPrimaria;
use App\Ct;
use App\CtsMaps;
use App\DatosGeneralesPrimaria;
use App\DireccionPrimaria;
use App\Especial;
use App\Fisica;
use App\GeneralEmpleados;
use App\GeneralesCts;
use App\GradosPrescolar;
use App\GradosPrimaria;
use App\GradosSecundaria;
use App\Graf1;
use App\GrafAdmin;
use App\GrafEdu;
use App\GrafOtros;
use App\GrafOtros2;
use App\GruposPres;
use App\GruposPrimaria;
use App\GruposSecu;
use App\Indigena;
use App\Inicial;
use App\Municipios;
use App\Plantilla;
use App\Prescolar;
use App\Primaria;
use App\SecuGral;
use App\SecuTec;
use App\SexoPres;
use App\SexoPrimaria;
use App\SexoSecu;
use App\Superior;
use App\TeleSec;
use App\TutoPrimaria;
use App\Usuarios;
use App\Blog;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function graf1()
    {
        return Graf1::all();
    }

    public function grafEdu1()
    {
        return GrafEdu::all();
    }

    public function grafEdu2($value)
    {
        $collection = Ct::groupBy('descripcion')
            ->selectRaw('count(*) as total, descripcion')
            ->where('tipo', '=', 'ESTRUCTURA EDUCATIVA' )
            ->where('nivel', '=', $value)
            ->get();
        return $collection;
    }

    public function grafEdu3($value)
    {
        switch ($value){
            case 'EDUCACION ESPECIAL':
                return Especial::all();
                break;
            case 'EDUCACION FISICA':
                return Fisica::all();
                break;
            case 'EDUCACION INDIGENA':
                return Indigena::all();
                break;
            case 'EDUCACION INICIAL':
                return Inicial::all();
                break;
            case 'EDUCACION PARA ADULTOS':
                return Adultos::all();
                break;
            case 'EDUCACION PREESCOLAR':
                return Prescolar::all();
                break;
            case 'EDUCACION PRIMARIA':
                return Primaria::all();
                break;
            case 'EDUCACION SECUNDARIA GENERAL':
                return SecuGral::all();
                break;
            case 'EDUCACION SECUNDARIA TECNICA':
                return SecuTec::all();
                break;
            case 'EDUCACION SUPERIOR':
                return Superior::all();
                break;
            case 'EDUCACION TELESECUNDARIA':
                return TeleSec::all();
                break;
            default:
                break;
        }

    }

    public function grafOtros1()
    {
        return GrafOtros::all();
    }

    public function grafOtros2()
    {
        return GrafOtros2::all();
    }

    public function grafAdmin1()
    {
        return GrafAdmin::all();
    }

    public function municipios()
    {
        return Municipios::orderBy('nombre', 'asc')
            ->get();
    }

    public function ctsmaps()
    {
        return CtsMaps::all();
    }

    public function ctsmaps2($array1, $array2)
    {
        $val11 = null;
        $val22 = null;

        if($array1 != 'null'){
            $arr1 = $array1;
            $arr1 = str_replace('[', "", $arr1);
            $arr1 = str_replace(']', "", $arr1);
            $arr1 = str_replace('"', "", $arr1);
            $val11 = explode(',', $arr1);
        }

        if($array2 != 'null'){
            $arr2 = $array2;
            $arr2 = str_replace('[', "", $arr2);
            $arr2 = str_replace(']', "", $arr2);
            $arr2 = str_replace('"', "", $arr2);
            $val22 = explode(',', $arr2);
        }

        $val1 = is_array($val11);
        $val2 = is_array($val22);

        $modalidades = array();
        $modalidades1 = array();
        $modalidades2 = array();
        $modalidades3 = array();

        foreach ($val22 as $value){
            switch ($value) {
                case "EDUCACION PRIMARIA":
                    $modalidades1 = ["DPR", "DPB", "PPR", "FIZ"];
                    break;
                case "EDUCACION SECUNDARIA GENERAL":
                    $modalidades2 = ['PES', 'DST', 'DTV', 'DSN', 'PST','DES'];
                    break;
                case "EDUCACION PRESCOLAR":
                    $modalidades3 = ['DCC', 'DJN', 'NJN', 'PJN'];
                    break;

            }
        }

        $modalidades = array_merge($modalidades1, $modalidades2,$modalidades3);


        if($val1 == false && $val2 == false){
            return CtsMaps::all();
        }

        elseif($val1 == true && $val2 == false){
            return CtsMaps::whereIn('nombre_mun' , $val11)
                ->get();
        }

        elseif($val1 == false && $val2 == true){
            return CtsMaps::whereIn('modalidad' , $modalidades)
                ->get();
        }

        elseif($val1 == true && $val2 == true){
            return CtsMaps::whereIn('nombre_mun' , $val11)
                ->whereIn('modalidad' , $modalidades)
                ->get();
        }

    }

    public function getCts($mun, $tipo,$cual)
    {
        switch ($cual){
            case 1:
                $collection = Ct::where('tipo', '=', $tipo)
                    ->where('nombre_mun', '=', $mun)
                    ->orderBy('nombre', 'asc')
                    ->get();
                return $collection;
                break;
            case 2:
                $collection = Ct::where('nivel', '=', $tipo)
                    ->where('nombre_mun', '=', $mun)
                    ->orderBy('nombre', 'asc')
                    ->get();
                return $collection;
                break;
            case 3:
                break;
            default:
                break;
        }

    }

    public function getGradosPrimaria($id){
        $grados = GradosPrimaria::where('ct_id', '=', $id )->get();
        if($grados){
            return $grados;
        }
    }

    public function getCt($clave){
        $ct = Ct::where('clave', '=', $clave )->first();
        if($ct){
            return $ct;
        }
    }

    public function getSexoPrimaria($id){
        $sexo = SexoPrimaria::where('ct_id', '=', $id )->get();
        if($sexo){
            return $sexo;
        }
    }

    public function getGruposPrimaria($id, $grado){
        $grupos = GruposPrimaria::where('ct_id', '=', $id )
            ->where('grado_id', '=', $grado)
            ->get();
        if($grupos){
            return $grupos;
        }
    }

    public function getAlumnosPrimaria($grupo_id){
        $alumnos = AlumnosPrimaria::where('grupo_id', '=', $grupo_id )
            ->orderBy('nombre', 'asc')
            ->get();
        if($alumnos){
            return $alumnos;
        }
    }

    public function getAlumPrim($grupo_id){
        $alumnos = AlumPrim::where('grupo_id', '=', $grupo_id )
            ->orderBy('nombre', 'asc')
            ->get();
        if($alumnos){
            return $alumnos;
        }
    }

    public function getGrupoPrimaria($id, $grado, $desciption){
        $grupo = GruposPrimaria::where('ct_id', '=', $id )
            ->where('grado_id', '=', $grado)
            ->where('descripcion', '=', $desciption)
            ->first();
        if($grupo){
            return $grupo;
        }
    }

    public function getCalifPrim($alumno_id){
        $alumno = AlumPrim::where('alumno_id', '=', $alumno_id )
            ->first();
        if($alumno){
            return $alumno;
        }
    }

    public function getDatosGralPrim($alumno_id){
        $datos = DatosGeneralesPrimaria::where('alumno_id', '=', $alumno_id)
            ->first();
        if($datos){
            return $datos;
        }
    }

    public function getDireccionPrim($alumno_id){
        $direccion = DireccionPrimaria::where('alumno_id', '=', $alumno_id)
            ->first();
        if($direccion){
            return $direccion;
        } else {
            return null;
        }
    }

    public function getTutoPrim($alumno_id){
        $direccion = TutoPrimaria::where('alumno_id', '=', $alumno_id)
            ->first();
        if($direccion){
            return $direccion;
        } else {
            return null;
        }
    }

    public function getAdicionalesPrim($alumno_id){
        $adicionales = AdicionalesPrimaria::where('alumno_id', '=', $alumno_id)
            ->first();
        if($adicionales){
            return $adicionales;
        } else {
            return null;
        }
    }

    public function getContactoPrim($alumno_id){
        $contacto = ContactoPrimaria::where('alumno_id', '=', $alumno_id)
            ->first();
        if($contacto){
            return $contacto;
        } else {
            return null;
        }
    }


    public function getGradosSecundaria($id){
        $grados = GradosSecundaria::where('ct_id', '=', $id )->orderBy('grado', 'asc')->get();
        if($grados){
            return $grados;
        }
    }

    public function getSexoSecu($id){
        $sexo = SexoSecu::where('ct_id', '=', $id )->get();
        if($sexo){
            return $sexo;
        }
    }


    public function getGruposSecu($id, $grado, $turno){
        if ($turno == 'null') {
            $grupo = GruposSecu::where('ct_id', '=', $id )
                ->where('grado_id', '=', $grado)
                ->get();
        } else {
            $grupo = GruposSecu::where('ct_id', '=', $id )
                ->where('grado_id', '=', $grado)
                ->where('turno_id', '=', $turno)
                ->get();
        }
        if($grupo){
            return $grupo;
        }
    }

    public function getAlumSec($grupo_id){
        $alumnos = AlumnSecu::where('grupo_id', '=', $grupo_id )
            ->orderBy('nombre', 'asc')
            ->get();
        if($alumnos){
            return $alumnos;
        }
    }

    public function getCalifSecu($alumno_id){
        $alumno = AlumnSecu::where('alumno_id', '=', $alumno_id )
            ->first();
        if($alumno){
            return $alumno;
        }
    }

    public function getGrupoSecu($id, $grado, $turno, $desciption){
        if ($turno == 0) {
            $grupo = GruposSecu::where('ct_id', '=', $id )
                ->where('grado_id', '=', $grado)
                ->where('descripcion', '=', $desciption)
                ->first();
        } else {
            $grupo = GruposSecu::where('ct_id', '=', $id )
                ->where('grado_id', '=', $grado)
                ->where('turno_id', '=', $turno)
                ->where('descripcion', '=', $desciption)
                ->first();
        }

        if($grupo){
            return $grupo;
        }
    }

    public function getGradosPres($id){
        $grados = GradosPrescolar::where('ct_id', '=', $id )->orderBy('grado', 'asc')->get();
        if($grados){
            return $grados;
        }
    }

    public function getSexoPres($id){
        $sexo = SexoPres::where('ct_id', '=', $id )->get();
        if($sexo){
            return $sexo;
        }
    }

    public function getGruposPres($id, $grado){
        $grupos = GruposPres::where('ct_id', '=', $id )
            ->where('grado_id', '=', $grado)
            ->get();
        if($grupos){
            return $grupos;
        }
    }

    public function getAlumPres($grupo_id){
        $alumnos = AlumnosPres::where('grupo_id', '=', $grupo_id )
            ->orderBy('nombre', 'asc')
            ->get();
        if($alumnos){
            return $alumnos;
        }
    }

    public function getGrupoPres($id, $grado, $desciption){
        $grupo = GruposPres::where('ct_id', '=', $id )
            ->where('grado_id', '=', $grado)
            ->where('descripcion', '=', $desciption)
            ->first();
        if($grupo){
            return $grupo;
        }
    }

    public function getGralCt($claveCt){
        $gralCt = GeneralesCts::where('clave_ct', '=', $claveCt)->first();
        if($gralCt){
            return $gralCt;
        }
    }

    public function getPlantilla($claveCt){
        $gralCt = Plantilla::where('ct_clave', '=', $claveCt)->groupBy('nombre')->orderBy('nombre', 'asc')->get();
        if($gralCt){
            return $gralCt;
        }
    }

    public function getGeneralEmpleados($rfc){
        $empleado = GeneralEmpleados::where('rfc', '=', $rfc)->first();
        if($empleado){
            return $empleado;
        }
    }

    public function getClavePresupuestal($rfc){
        $clave = Plantilla::where('rfc', '=', $rfc)->get();
        if($clave){
            return $clave;
        }
    }

    public function searchAlumnos($nombre){
        $nomb = explode(' ', $nombre);
        //var_dump($nombre); die;

        $name = DB::Table('alumnos_search')
            ->select('alumno_id', 'nombre','nivel','clave', 'escuela', 'municipio', 'localidad')
            ->Where(function ($query) use($nomb) {
                for ($i = 0; $i < count($nomb); $i++){
                    $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                }
            })->orderBy('nombre', 'asc')->groupBy('alumno_id')->get();

        return $name;
    }

    public function filterAlumnos($array1, $array2, $nombre)
    {
        $nomb = explode(' ', $nombre);

        if($array2 != 'null'){
            switch ($array2) {
                case "EDUCACION PRIMARIA":
                    $modalidades = 2;
                    break;
                case "EDUCACION SECUNDARIA GENERAL":
                    $modalidades = 3;
                    break;
                case "EDUCACION PRESCOLAR":
                    $modalidades = 1;
                    break;

            }
        }
        $value1 = $array1 == 'null' ? 0 : $array1;
        $value2 = $array2 == 'null' ? 0 : $array2;



        if($value1 === 0 && $value2 === 0){
            return DB::Table('alumnos_search')
                ->select('alumno_id', 'nombre','nivel','clave', 'escuela', 'municipio', 'localidad')
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('alumno_id')->get();

        }

        elseif($value1 !== 0 && $value2 === 0){
            return DB::Table('alumnos_search')
                ->select('alumno_id', 'nombre','nivel','clave', 'escuela', 'municipio', 'localidad')
                ->Where('municipio' , $array1)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('alumno_id')->get();

        }

        elseif($value1 === 0 && $value2 ==! 0){
            return DB::Table('alumnos_search')
                ->select('alumno_id', 'nombre','nivel','clave', 'escuela', 'municipio', 'localidad')
                ->Where('nivel' , $modalidades)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('alumno_id')->get();
        }
        elseif($value1 ==! 0 && $value2 ==! 0){
            return DB::Table('alumnos_search')
                ->select('alumno_id', 'nombre','nivel','clave', 'escuela', 'municipio', 'localidad')
                ->Where('municipio' , $array1)
                ->Where('nivel' , $modalidades)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('alumno_id')->get();
        }

    }

    public function searchEscuelas($nombre){
        $nomb = explode(' ', $nombre);
        //var_dump($nombre); die;

        $name = DB::Table('cts')
            ->select('clave', 'nombre','nombre_mun', 'localidad', 'modalidad')
            ->Where(function ($query) use($nomb) {
                for ($i = 0; $i < count($nomb); $i++){
                    $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                }
            })->orderBy('nombre', 'asc')->groupBy('clave')->get();

        return $name;
    }

    public function filterEscuelas($array1, $array2, $nombre)
    {
        $nomb = explode(' ', $nombre);

        if($array2 != 'null'){
            switch ($array2) {
                case "EDUCACION PRIMARIA":
                    $modalidades = ["DPR", "DPB", "PPR", "FIZ"];
                    break;
                case "EDUCACION SECUNDARIA GENERAL":
                    $modalidades = ["PES", "DST", "DTV", "DSN", "PST","DES"];
                    break;
                case "EDUCACION PRESCOLAR":
                    $modalidades = ["DCC", "DJN", "NJN", "PJN"];
                    break;

            }
        }
        $value1 = $array1 == 'null' ? 0 : $array1;
        $value2 = $array2 == 'null' ? 0 : $array2;



        if($value1 === 0 && $value2 === 0){
            return DB::Table('cts')
                ->select('clave', 'nombre','nombre_mun', 'localidad')
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('clave')->get();

        }

        elseif($value1 !== 0 && $value2 === 0){
            return DB::Table('cts')
                ->select('clave', 'nombre','nombre_mun', 'localidad')
                ->Where('nombre_mun' , $array1)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('clave')->get();

        }

        elseif($value1 === 0 && $value2 ==! 0){
            return DB::Table('cts')
                ->select('clave', 'nombre','nombre_mun', 'localidad')
                ->WhereIn('modalidad' , $modalidades)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })
                ->orderBy('nombre', 'asc')->groupBy('clave')->get();
        }
        elseif($value1 ==! 0 && $value2 ==! 0){
            return DB::Table('cts')
                ->select('clave', 'nombre','nombre_mun', 'localidad')
                ->WhereIn('modalidad' , $modalidades)
                ->Where('nombre_mun' , $array1)
                ->Where(function ($query) use($nomb) {
                    for ($i = 0; $i < count($nomb); $i++){
                        $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                    }
                })->orderBy('nombre', 'asc')->groupBy('clave')->get();
        }

    }

    public function searchDocentes($nombre){
        $nomb = explode(' ', $nombre);
        //var_dump($nombre); die;

        $name = DB::Table('plantilla')
            ->select('rfc', 'nombre')
            ->Where(function ($query) use($nomb) {
                for ($i = 0; $i < count($nomb); $i++){
                    $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                }
            })->orderBy('nombre', 'asc')->groupBy('rfc')->get();

        return $name;
    }

    public function filterDocentes($nombre, $mun){
        $nomb = explode(' ', $nombre);
        //var_dump($nombre); die;

        $name = DB::Table('plantilla')
            ->select('rfc', 'nombre')
            ->Where('nombre_mun' , $mun)
            ->Where(function ($query) use($nomb) {
                for ($i = 0; $i < count($nomb); $i++){
                    $query->where('nombre', 'like',  '%' . $nomb[$i] .'%');
                }
            })->orderBy('nombre', 'asc')->groupBy('rfc')->get();

        return $name;
    }

    public function searchUser($user){
        $verify = Usuarios::where('user', '=', $user )->get();

        if(count($verify) > 0){
            return 1;
        } else {
            return 2;
        }
    }

    public function loginFor($user, $pass){
        $verify = Usuarios::where('user', '=', $user)->where('pass', '=', $pass)->get();
        if(count($verify) > 0){
            return 1;
        } else {
            return 2;
        }
    }

    public function blog(){
        return Blog::all();
    }

    public function article($id){
        return Blog::where('id', '=', $id )->first();
    }

}
