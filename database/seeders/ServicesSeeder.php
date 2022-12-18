<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ["name" => 'Troca de Óleo', "price" => 50],
            ["name" => 'Pintura', "price" => 1800],
            ["name" => 'Mão de Obra', "price" => 200],
            ["name" => 'Revisão', "price" => 180]
        ];

        foreach ($array as $value) {
            Service::create($value);
        }
    }
}
