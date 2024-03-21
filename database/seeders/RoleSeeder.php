<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['tipe' => 'admin' ],
            ['tipe' => 'supplier' ],
            ['tipe' => 'dealer' ],
            ['tipe' => 'biller' ],
            ['tipe' => 'default' ],
        ];
    
        foreach ($data as $value)
            {
                Role::insert([
                    'tipe' => $value['tipe'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
    }

    
}
