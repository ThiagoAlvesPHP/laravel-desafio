<?php

namespace Database\Seeders;

use App\Models\ModelBrand;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ["brand_id" => 1, "name" => 'Fiesta 1.0 5P'],
            ["brand_id" => 1, "name" => 'Fiesta 1.4 5P'],
            ["brand_id" => 1, "name" => 'Focus 1.4'],
            ["brand_id" => 2, "name" => 'Palio 1.0'],
            ["brand_id" => 2, "name" => 'Palio 1.6'],
            ["brand_id" => 3, "name" => 'Fox 1.0'],
            ["brand_id" => 3, "name" => 'Fox 1.4'],
        ];

        foreach ($array as $value) {
            ModelBrand::create($value);
        }
    }
}
