<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoryDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        factory(\Modules\Store\Entities\Category::class, 5)->create();
    }
}
