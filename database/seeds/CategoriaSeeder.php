<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayItems = ['Restaurant','Café', 'Hotel', 'Hospital', 'Gimnasio', 'Doctor', 'Bar'];

        foreach($arrayItems as $value){
            DB::table('categorias')->insert([
                'nombre' => $value,
                'slug' => Str::slug($value),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

    }
}
