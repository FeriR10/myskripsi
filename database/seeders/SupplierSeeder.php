<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Supplier::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama' => 'telkomsel' ],
            ['nama' => 'indosat' ],
            ['nama' => 'three' ],
        ];
    
        foreach ($data as $value)
            {
                Supplier::insert([
                    'nama' => $value['nama'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }
}
