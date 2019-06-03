<?php

namespace App\Http\Controllers;

use App\AdicionalesPrimaria;
use App\Adultos;
use App\AlumnosPrimaria;
use App\AlumPrim;
use App\ContactoPrimaria;
use App\Ct;
use App\CtsMaps;
use App\DatosGeneralesPrimaria;
use App\DireccionPrimaria;
use App\Especial;
use App\Fisica;
use App\GradosPrimaria;
use App\GradosSecundaria;
use App\Graf1;
use App\GrafAdmin;
use App\GrafEdu;
use App\GrafOtros;
use App\GrafOtros2;
use App\GruposPrimaria;
use App\Indigena;
use App\Inicial;
use App\Municipios;
use App\Prescolar;
use App\Primaria;
use App\SecuGral;
use App\SecuTec;
use App\SexoPrimaria;
use App\Superior;
use App\TeleSec;
use App\TutoPrimaria;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

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
        return Municipios::all();
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



        if($val1 == false && $val2 == false){
            return CtsMaps::all();
        }

        elseif($val1 == true && $val2 == false){
            return CtsMaps::whereIn('nombre_mun' , $val11)
                ->get();
        }

        elseif($val1 == false && $val2 == true){
            return CtsMaps::whereIn('nivel' , $val22)
                ->get();
        }

        elseif($val1 == true && $val2 == true){
            return CtsMaps::whereIn('nombre_mun' , $val11)
                ->whereIn('nivel' , $val22)
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
            ->get();
        if($alumnos){
            return $alumnos;
        }
    }

    public function getAlumPrim($grupo_id){
        $alumnos = AlumPrim::where('grupo_id', '=', $grupo_id )
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
        $grados = GradosSecundaria::where('ct_id', '=', $id )->get();
        if($grados){
            return $grados;
        }
    }

}
