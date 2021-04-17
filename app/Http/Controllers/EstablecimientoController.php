<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Consultar Categorrias
        $categorias = Categoria::all();

        return view('establecimiento.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // Validacion
        $data = $request->validate([
                'nombre' => 'required',
                'categoria_id' => 'required|exists:App\Categoria,id',
                'imagen_principal' => 'required|image|max:1000',
                'direccion' => 'required',
                'colonia'=> 'required',
                'lat' =>'required',
                'lng' => 'required',
                'telefono' => 'required|numeric',
                'descripcion' => 'required|min:50',
                'apertura' => 'date_format:H:i',
                'cierre' =>  'date_format:H:i|after:apertura',
                'uuid' =>  'required|uuid'

            ]);

        // Guardar la iamgen

               // Guardar la imagen
               $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

               // Resize a la imagen
               $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(800, 600);
               $img->save();

                $establecimiento = new Establecimiento($data);
                $establecimiento->imagen_principal = $ruta_imagen;
                $establecimiento->user_id = Auth::user()->id;
                $establecimiento->save();


                // Metodo 2 | No requiren que el modelo exixta el campo user_id

            //    auth()->user()->establecimiento()->create([
            //             'nombre' => $data['nombre'],
            //             'categoria_id' => $data['categoria_id'],
            //             'imagen_principal' => $ruta_imagen,
            //             'direccion' => $data['direccion'],
            //             'colonia'=> $data['colonia'],
            //             'lat' => $data['lat'],
            //             'lng' => $data['lng'],
            //             'telefono' => $data['telefono'],
            //             'descripcion' => $data['descripcion'],
            //             'apertura' => $data['apertura'],
            //             'cierre' =>  $data['cierre'],
            //             'uuid' =>  $data['uuid']
            //    ]);



        return back()->with('estado', 'Tu información se almaceno correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        // Ejecutar el policiy
        $this->authorize('view', $establecimiento);


         // Consultar Categorrias
         $categorias = Categoria::all();

        $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
        $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));

        //oBTIENES LAS IAMGENES DEL ESTABLECIMEINTOS
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        return  view('establecimiento.edit', compact('categorias', 'establecimiento','imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
            // Ejecutar el policiy
            $this->authorize('update', $establecimiento);

          // // Validacion
          $data = $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'image|max:1000',
            'direccion' => 'required',
            'colonia'=> 'required',
            'lat' =>'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'date_format:H:i',
            'cierre' =>  'date_format:H:i|after:apertura',
            'uuid' =>  'required|uuid'

        ]);

        // Actualizamos
        $establecimiento->nombre = $data['nombre'];
        $establecimiento->categoria_id = $data['categoria_id'];
        $establecimiento->direccion = $data['direccion'];
        $establecimiento->colonia = $data['colonia'];
        $establecimiento->lat = $data['lat'];
        $establecimiento->lng = $data['lng'];
        $establecimiento->telefono = $data['telefono'];
        $establecimiento->descripcion = $data['descripcion'];
        $establecimiento->apertura = $data['apertura'];
        $establecimiento->cierre = $data['cierre'];
        $establecimiento->uuid = $data['uuid'];

        // Si el usuario sube un imagen

        if(request(['imagen_principal'])){

               // Guardar la imagen
               $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

               // Resize a la imagen
               $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(800, 600);
               $img->save();

               // asignamos
               $establecimiento->imagen_principal = $ruta_imagen;
        }

        $establecimiento->save();

        return back()->with('estado','Tu información se almacenó correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
