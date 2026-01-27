<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintTopicsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('complaint_topics')->updateOrInsert([
            ['name' => 'Ambiente de trabajo'],
            ['name' => 'Jornadas de trabajo extensas'],
            ['name' => 'Violencia laboral'],
            ['name' => 'Cargas de trabajo'],
            ['name' => 'Liderazgo'],
            ['name' => 'Otros'],
        ]);
    }
}
