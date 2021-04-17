<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //


    // Leer las rutas por slug y no por ID
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // 1:M | Una categoria va tener muchos establecimientos

    public function establecimiento(){
        return $this->hasMany(Establecimiento::class);
    }
}
