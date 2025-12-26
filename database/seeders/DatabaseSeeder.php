<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Cast\Void_;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(AdminUserSeeder::class);
    }
}
