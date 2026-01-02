<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marques = [
            ['nom' => 'HP', 'description' => 'Hewlett-Packard', 'logo' => 'marques/hp.png'],
            ['nom' => 'Dell', 'description' => 'Dell Technologies', 'logo' => 'marques/dell.png'],
            ['nom' => 'Lenovo', 'description' => 'Lenovo Group Limited', 'logo' => 'marques/lenovo.png'],
            ['nom' => 'Apple', 'description' => 'Apple Inc.', 'logo' => 'marques/apple.png'],
            ['nom' => 'Asus', 'description' => 'ASUSTeK Computer Inc.', 'logo' => 'marques/asus.png'],
            ['nom' => 'Acer', 'description' => 'Acer Inc.', 'logo' => 'marques/acer.png'],
            ['nom' => 'Logitech', 'description' => 'Logitech International S.A.', 'logo' => 'marques/logitech.png'],
            ['nom' => 'Epson', 'description' => 'Seiko Epson Corporation', 'logo' => 'marques/epson.png'],
            ['nom' => 'Microsoft', 'description' => 'Microsoft Corporation', 'logo' => 'marques/microsoft.png'],
            ['nom' => 'Cisco', 'description' => 'Cisco Systems, Inc.', 'logo' => 'marques/cisco.png'],
            ['nom' => 'Canon', 'description' => 'Canon Inc.', 'logo' => 'marques/canon.png'],
            ['nom' => 'Brother', 'description' => 'Brother Industries, Ltd.', 'logo' => 'marques/brother.png'],
        ];

        foreach ($marques as $marque) {
            Marque::updateOrCreate(['nom' => $marque['nom']], $marque);
        }
    }
}
