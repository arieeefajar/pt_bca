<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NamaProdukBenih extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "benih_id"=> "1",
                "nama"=> "BETRAS 1",
            ],
            [
                "benih_id"=> "1",
                "nama"=> "BETRAS 4",
            ],
            [
                "benih_id"=> "1",
                "nama"=> "BETRAS 9",
            ],
            [
                "benih_id"=> "1",
                "nama"=> "BETRAS 10",
            ],
            [
                "benih_id"=> "2",
                "nama"=> "BCA 18",
            ],
            [
                "benih_id"=> "4",
                "nama"=> "MEGATOP F1",
            ],
            [
                "benih_id"=> "5",
                "nama"=> "GENIE",
            ],
            [
                "benih_id"=> "5",
                "nama"=> "KARA F1",
            ],
            [
                "benih_id"=> "6",
                "nama"=> "JURO F1",
            ],
            [
                "benih_id"=> "7",
                "nama"=> "STABIL F1",
            ],
            [
                "benih_id"=> "7",
                "nama"=> "SWEETOP",
            ],
            [
                "benih_id"=> "8",
                "nama"=> "PANZER",
            ],
            [
                "benih_id"=> "9",
                "nama"=> "HANOMAN F1",
            ],
            [
                "benih_id"=> "10",
                "nama"=> "ALMOND F1",
            ],
            [
                "benih_id"=> "10",
                "nama"=> "SUPRIME F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "SEMI F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "SAENA F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "MONAS F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "KOMANDAN F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "TISURI F1",
            ],
            [
                "benih_id"=> "11",
                "nama"=> "RENES F1",
            ],
            [
                "benih_id"=> "12",
                "nama"=> "HOKIAN F1",
            ],
            [
                "benih_id"=> "12",
                "nama"=> "YUNAN F1",
            ],
            [
                "benih_id"=> "12",
                "nama"=> "HAINAN F1",
            ],
            [
                "benih_id"=> "12",
                "nama"=> "DATUK F1",
            ],
            [
                "benih_id"=> "13",
                "nama"=> "BLASTER F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "MADRID F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "MARDY F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "INDEN F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "SERI F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "DIVA F1",
            ],
            [
                "benih_id"=> "14",
                "nama"=> "MADURI F1",
            ],
            [
                "benih_id"=> "15",
                "nama"=> "JUMBO F1",
            ],
            [
                "benih_id"=> "15",
                "nama"=> "MERLIN F1",
            ],
            [
                "benih_id"=> "15",
                "nama"=> "MYLOVE F1",
            ],
            [
                "benih_id"=> "16",
                "nama"=> "REMPAI",
            ],
            [
                "benih_id"=> "16",
                "nama"=> "GRANDSAGENA F1",
            ],
            [
                "benih_id"=> "16",
                "nama"=> "CITRA ASIA F1",
            ],
            [
                "benih_id"=> "16",
                "nama"=> "FIESTA F1",
            ],
            [
                "benih_id"=> "17",
                "nama"=> "KENARI",
            ],
            [
                "benih_id"=> "17",
                "nama"=> "BONDAN",
            ],
            [
                "benih_id"=> "17",
                "nama"=> "BUNGO F1",
            ],
            [
                "benih_id"=> "25",
                "nama"=> "ARISTA",
            ],
            [
                "benih_id"=> "26",
                "nama"=> "PUTERI",
            ],
            [
                "benih_id"=> "26",
                "nama"=> "CAK COY",
            ],
            [
                "benih_id"=> "27",
                "nama"=> "MAJAPAHIT",
            ],
            [
                "benih_id"=> "28",
                "nama"=> "DAMPIT",
            ],
            [
                "benih_id"=> "29",
                "nama"=> "RED",
            ],
            [
                "benih_id"=> "29",
                "nama"=> "SAMARIN",
            ],
        ];
        foreach ($data as $value) {
            \App\Models\NamaProdukBenih::create([
                'benih_id' => $value['benih_id'],
                'nama' => $value['nama'],
            ]);
        }
    }
}
