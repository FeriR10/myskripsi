<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Pulsa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PulsaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Pulsa::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nominal' => '5000' ],
            ['nominal' => '10000' ],
            ['nominal' => '15000' ],
            ['nominal' => '20000' ],
            ['nominal' => '25000' ],
        ];
    
        foreach ($data as $value)
            {
                Pulsa::insert([
                    'nominal' => $value['nominal'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }
}
