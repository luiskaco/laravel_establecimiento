<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;


/**
 * NOta: SE CONSULTA LA RUTA ANTEPONIENDO API/RUTA
 */


class ApiController extends Controller
{
    // Para obtene todos los estabelcimientos
    public function index()
    {
        $establecimientos = Establecimiento::with('categoria')->get();

        return response()->json($establecimientos);
    }

    // Metodo para obtener todas las categorias
    public function cantegorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }


    // Muestra los establecimiento de la categoria en especificos
    public function cantegoria(Categoria $categoria)
    {

        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();

        // No jala la categora solo la consulta sin el id de categoria
        $categoria->establecimiento;

        return response()->json($establecimiento);
    }

    // Buscando establecimientos especifico

    public function show(Establecimiento $establecimiento)
    {
        $imagenes = Imagen::where('id_establecimiento',$establecimiento->uuid )->get();
        $establecimiento->imagenes = $imagenes;

        return response()->json($establecimiento);
    }

    // Listar todos los establecimiento basado en la categoria
    public function establecimientocategoria(Categoria $categoria)
    {
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();

        return response()->json($establecimiento);
    }

}
