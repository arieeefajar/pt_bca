<?php

namespace Database\Seeders;

use App\Models\SuggestionPotensionalArea;
use App\Models\SuggestionRetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Suggestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pathAnalisisPesaing = base_path('database/seeders/dataJson/sugestionAnalisisPesaing.json');
        $readAnalisisPesaing = file_get_contents($pathAnalisisPesaing);
        $jsonAlisisPesaing = [json_decode($readAnalisisPesaing, true)];

        $pathPotensiLahan = base_path('database/seeders/dataJson/sugestionPotensiLahan.json');
        $readPotensiLahan = file_get_contents($pathPotensiLahan);
        $jsonPotensiLahan = [json_decode($readPotensiLahan, true)];

        // retail
        foreach ($jsonAlisisPesaing[0] as $key => $val) {
            SuggestionRetail::create([
                'name' => $key,
                'suggestion' => $val
            ]);
        }

        // potentional area
        foreach ($jsonPotensiLahan[0] as $key => $val) {
            SuggestionPotensionalArea::create([
                'name' => $key,
                'suggestion' => $val
            ]);
        }
    }
}
