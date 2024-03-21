<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Biller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BillerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Biller::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama' => 'biller A' ],
            ['nama' => 'biller B' ],
            ['nama' => 'biller C' ],
        ];
    
        foreach ($data as $value)
            {
                Biller::insert([
                    'nama' => $value['nama'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }
}
