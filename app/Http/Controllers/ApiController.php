<?php

namespace App\Http\Controllers;

use App\Adultos;
use App\Ct;
use App\CtsMaps;
use App\Especial;
use App\Fisica;
use App\Graf1;
use App\GrafAdmin;
use App\GrafEdu;
use App\GrafOtros;
use App\GrafOtros2;
use App\Indigena;
use App\Inicial;
use App\Municipios;
use App\Prescolar;
use App\Primaria;
use App\SecuGral;
use App\SecuTec;
use App\Superior;
use App\TeleSec;
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
        if($array1 == null && $array2 == null){
            return CtsMaps::all();
        }

        if($array1 != null && $array2 == null){
            return CtsMaps::whereIn('nombre_mun' , $array1)
                ->get();
        }

        if($array1 == null && $array2 != null){
            return CtsMaps::whereIn('nivel' , $array2)
                ->get();
        }

        if($array1 != null && $array2 != null){
            return CtsMaps::whereIn('nombre_mun' , $array1)
                ->whereIn('nivel' , $array2)
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

}
