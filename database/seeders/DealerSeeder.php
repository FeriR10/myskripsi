<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Dealer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Dealer::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama' => 'dealer A' ],
            ['nama' => 'dealer B' ],
            ['nama' => 'dealer C' ],
        ];
    
        foreach ($data as $value)
            {
                Dealer::insert([
                    'nama' => $value['nama'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }
}
