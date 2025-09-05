<?php

namespace App\Repositories;

use App\Models\Inscripcion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class InscripcionRepository
{

    protected $inscripcion;

    public function __construct(Inscripcion $inscripcion)
    {
        $this->inscripcion = $inscripcion;
    }

    public function listar()
    {
        $inscripciones = Inscripcion::with(['user','curso'])
                                    ->whereNull('user_eliminador_id')
                                    ->orderBy('id')
                                    ->get();
        
        return $inscripciones;
    }

    public function guardar($request)
    {
        $inscripcion = new Inscripcion();
        $inscripcion->fecha_inscripcion = date('Y-m-d H:i:s');
        $inscripcion->nota              = $request->nota;
        $inscripcion->nota_literal      = Str::upper($this->obtenerNumeroLiteral($request->nota));//Str::upper($request->nota_literal);
        $inscripcion->estado            = 'INSCRITO';
        $inscripcion->user_id           = $request->user_id;
        $inscripcion->curso_id          = $request->curso_id;
        $inscripcion->user_creador_id   = Auth::id();
        $inscripcion->fecha_creacion    = date('Y-m-d H:i:s');
        $inscripcion->save();

        return $inscripcion;
    }

    public function obtener($id)
    {
        $inscripcion = Inscripcion::with(['user','curso'])
                                    ->whereNull('user_eliminador_id')
                                    ->where("id", $id) 
                                    ->first();

        return $inscripcion;
    }

    public function editar($request, $id)
    {
        $inscripcion = Inscripcion::whereNull('user_eliminador_id')
                                    ->where('id', $id)
                                    ->first();
                                    
        $inscripcion->nota              = $request->nota;
        $inscripcion->nota_literal      = Str::upper($this->obtenerNumeroLiteral($request->nota));//Str::upper($request->nota_literal);
        //$inscripcion->estado            = $request->estado;
        $inscripcion->user_id           = $request->user_id;
        $inscripcion->curso_id          = $request->curso_id;
        $inscripcion->user_modificador_id   = Auth::id();
        $inscripcion->fecha_modificacion    = date('Y-m-d H:i:s');
        $inscripcion->save();

        return $inscripcion;
    }

    public function eliminar($id)
    {
        $inscripcion = Inscripcion::whereNull('user_eliminador_id')
                                    ->where('id', $id)
                                    ->first();
        //$inscripcion->delete();
        $inscripcion->user_eliminador_id = Auth::id();
        $inscripcion->fecha_eliminacion  = date('Y-m-d H:i:s');
        $inscripcion->save();

        return $inscripcion;
    }

    public function verificaInscripcion($request)
    {
        $inscripcion = Inscripcion::whereNull('user_eliminador_id')
                                    ->where('user_id', $request->user_id)
                                    ->where('curso_id', $request->curso_id)
                                    ->first();

        return $inscripcion;
    }

    public function listarPorUsuario()
    {
        $inscripciones = Inscripcion::with(['user','curso'])
                                    ->where('user_id', Auth::id())
                                    ->whereNull('user_eliminador_id')
                                    ->orderBy('id')
                                    ->get();
        
        return $inscripciones;
    }

    public function obtenerNumeroLiteral($number)
    {
        if($number == null || $number == ""){
            return null;
        }

        switch ((int) $number) {
            case 0: return "Cero"; break;
            case 1: return "Uno"; break;
            case 2: return "Dos"; break;
            case 3: return "Tres"; break;
            case 4: return "Cuatro"; break;
            case 5: return "Cinco"; break;
            case 6: return "Seis"; break;
            case 7: return "Siete"; break;
            case 8: return "Ocho"; break;
            case 9: return "Nueve"; break;
            case 10: return "Diez"; break;
            case 11: return "Once"; break;
            case 12: return "Doce"; break;
            case 13: return "Trece"; break;
            case 14: return "Catorce"; break;
            case 15: return "Quince"; break;
            case 16: return "Dieciséis"; break;
            case 17: return "Diecisiete"; break;
            case 18: return "Dieciocho"; break;
            case 19: return "Diecinueve"; break;
            case 20: return "Veinte"; break;
            case 21: return "Veintiuno"; break;
            case 22: return "Veintidós"; break;
            case 23: return "Veintitres"; break;
            case 24: return "Veinticuatro"; break;
            case 25: return "Veinticinco"; break;
            case 26: return "Veintiseis"; break;
            case 27: return "Veintisiete"; break;
            case 28: return "Veintiocho"; break;
            case 29: return "Veintinueve"; break;
            case 30: return "Treinta"; break;
            case 31: return "Treinta y uno"; break;
            case 32: return "Treinta y dos"; break;
            case 33: return "Treinta y tres"; break;
            case 34: return "Treinta y cuatro"; break;
            case 35: return "Treinta y cinco"; break;
            case 36: return "Treinta y seis"; break;
            case 37: return "Treinta y siete"; break;
            case 38: return "Treinta y ocho"; break;
            case 39: return "Treinta y nueve"; break;
            case 40: return "Cuarenta"; break;
            case 41: return "Cuarenta y uno"; break;
            case 42: return "Cuarenta y dos"; break;
            case 43: return "Cuarenta y tres"; break;
            case 44: return "Cuarenta y cuatro"; break;
            case 45: return "Cuarenta y cinco"; break;
            case 46: return "Cuarenta y seis"; break;
            case 47: return "Cuarenta y siete"; break;
            case 48: return "Cuarenta y ocho"; break;
            case 49: return "Cuarenta y nueve"; break;
            case 50: return "Cincuenta"; break;
            case 51: return "Cincuenta y uno"; break;
            case 52: return "Cincuenta y dos"; break;
            case 53: return "Cincuenta y tres"; break;
            case 54: return "Cincuenta y cuatro"; break;
            case 55: return "Cincuenta y cinco"; break;
            case 56: return "Cincuenta y seis"; break;
            case 57: return "Cincuenta y siete"; break;
            case 58: return "Cincuenta y ocho"; break;
            case 59: return "Cincuenta y nueve"; break;
            case 60: return "Sesenta"; break;
            case 61: return "Sesenta y uno"; break;
            case 62: return "Sesenta y dos"; break;
            case 63: return "Sesenta y tres"; break;
            case 64: return "Sesenta y cuatro"; break;
            case 65: return "Sesenta y cinco"; break;
            case 66: return "Sesenta y seis"; break;
            case 67: return "Sesenta y siete"; break;
            case 68: return "Sesenta y ocho"; break;
            case 69: return "Sesenta y nueve"; break;
            case 70: return "Setenta"; break;
            case 71: return "Setenta y uno"; break;
            case 72: return "Setenta y dos"; break;
            case 73: return "Setenta y tres"; break;
            case 74: return "Setenta y cuatro"; break;
            case 75: return "Setenta y cinco"; break;
            case 76: return "Setenta y seis"; break;
            case 77: return "Setenta y siete"; break;
            case 78: return "Setenta y ocho"; break;
            case 79: return "Setenta y nueve"; break;
            case 80: return "Ochenta"; break;
            case 81: return "Ochenta y uno"; break;
            case 82: return "Ochenta y dos"; break;
            case 83: return "Ochenta y tres"; break;
            case 84: return "Ochenta y cuatro"; break;
            case 85: return "Ochenta y cinco"; break;
            case 86: return "Ochenta y seis"; break;
            case 87: return "Ochenta y siete"; break;
            case 88: return "Ochenta y ocho"; break;
            case 89: return "Ochenta y nueve"; break;
            case 90: return "Noventa"; break;
            case 91: return "Noventa y uno"; break;
            case 92: return "Noventa y dos"; break;
            case 93: return "Noventa y tres"; break;
            case 94: return "Noventa y cuatro"; break;
            case 95: return "Noventa y cinco"; break;
            case 96: return "Noventa y seis"; break;
            case 97: return "Noventa y siete"; break;
            case 98: return "Noventa y ocho"; break;
            case 99: return "Noventa y nueve"; break;
            case 100: return "Cien"; break;
        }
    }

}