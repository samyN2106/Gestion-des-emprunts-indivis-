<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modality;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modality::create([
            'modality_label' => 'Amortissement variable'
        ]);
        Modality::create([
            'modality_label' => 'Amortissement constant'
        ]);
        Modality::create([
            'modality_label' => 'annuite constante'
        ]);
        Modality::create([
            'modality_label' => 'Remboursement In-fine absolu '
        ]);
        Modality::create([
            'modality_label' => 'Remboursement In-fine relatif '
        ]);
    }
}
