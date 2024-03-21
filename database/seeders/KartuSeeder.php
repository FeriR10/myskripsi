<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kartu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KartuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kartu::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama' => 'telkomsel', 'supplier_id' => 1 ],
            ['nama' => 'indosat', 'supplier_id' => 2 ],
            ['nama' => 'three', 'supplier_id' => 3 ],
        ];
    
        foreach ($data as $value)
            {
                Kartu::insert([
                    'nama' => $value['nama'],
                    'supplier_id' => $value['supplier_id'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }
}
