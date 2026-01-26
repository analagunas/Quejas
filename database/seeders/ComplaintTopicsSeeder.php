<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ComplaintTopic;

class ComplaintTopicsSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Ambiente de trabajo',
            'Jornadas de trabajo extensas',
            'Violencia laboral (Acoso psicológico, hostigamiento, malos tratos, etc.)',
            'Cargas de trabajo',
            'Liderazgo',
            'Otros',
        ];

        foreach ($topics as $topic) {
            ComplaintTopic::firstOrCreate([
                'name' => $topic
            ]);
        }
    }
}
