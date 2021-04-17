<?php

namespace App\Http\Controllers;

use App\Establecimiento;
use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {

        if($request->ajax()){

            // Leer la imagen
            $ruta_imagen = $request->file('file')->store('establecimiento','public');

            // Resize a la imagen
            $imagen = Image::make(public_path("storage/{$ruta_imagen}") )->fit(800, 450);
            $imagen->save(); // Volviendo a guardar

            // Almacenar con modelo
            $imagenDB = new Imagen;
            $imagenDB->id_establecimiento = $request['uuid']; // $request->uuid
            $imagenDB->ruta_imagen = $ruta_imagen;

            $imagenDB->save();

            // Retornar Respuesta
            $respuesta = [
                'archivo' => $ruta_imagen
            ];

            return response()->json($respuesta);

            /**
             * Nota: los arreglos asociativos no existe en JS, para que puedea leerlo en php usando json decode
             */

            return $request->file('file');
            return response()->json($request->file('file')); // Sirve para ver el request de las iamgenes
            return response()->json($request->all()); // Sirve para ver el request de texto plano

        }
    }

    // Elimina una imagen de la  BD y del servidor
    public function destroy(Request $request)
    {
        /// Verificar que el uuid sea el registrdo para eliminar
        $uuid = $request->get('uuid');
        $establecimiento = Establecimiento::where('uuid', $uuid)->first();
        // Ejecutar el policiy
        $this->authorize('delete', $establecimiento);

        // Eliminar ima
        $imagen = $request->get('imagen');



        if(File::exists('storage/' . $imagen))
        {
            // ELimina imagen del servidor
             File::delete('storage/'. $imagen);

             // ELimiando de la BD
             Imagen::where('ruta_imagen', '=' , $imagen)->delete();

               // Respuesta
                $respuesta = [
                    'imagen_eliminar' => $imagen,
                    // 'uuid' => $uuid,
                    'mensaje' => "Imagen Eliminada"
                ];

        }





        // metodo 2
        // $imagenEliminar = Imagen::where('ruta_imagen', '=', $imagen)->firstOrFail();
        // Imagen::destroy($imagenEliminar->id);

        return response()->json($respuesta);
        return response()->json($request);

    }
}
