<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks for MySQL
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables
        Division::truncate();
        District::truncate();
        Upazila::truncate();

        // Enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create divisions
        $ec1 = Division::create(['name' => 'Division EC1', 'code' => 'EC1']);
        $ec2 = Division::create(['name' => 'Division EC2', 'code' => 'EC2']);
        $ec3 = Division::create(['name' => 'Division EC3', 'code' => 'EC3']);

        // Create districts for EC1
        $a = District::create(['division_id' => $ec1->id, 'name' => 'District A', 'code' => 'A']);
        $b = District::create(['division_id' => $ec1->id, 'name' => 'District B', 'code' => 'B']);

        // Create districts for EC2
        $c = District::create(['division_id' => $ec2->id, 'name' => 'District C', 'code' => 'C']);
        $d = District::create(['division_id' => $ec2->id, 'name' => 'District D', 'code' => 'D']);

        // Create districts for EC3
        $e = District::create(['division_id' => $ec3->id, 'name' => 'District E', 'code' => 'E']);
        $f = District::create(['division_id' => $ec3->id, 'name' => 'District F', 'code' => 'F']);

        // Create upazilas
        Upazila::create(['district_id' => $a->id, 'name' => 'Upazila A1', 'code' => 'A1']);
        Upazila::create(['district_id' => $a->id, 'name' => 'Upazila A2', 'code' => 'A2']);
        Upazila::create(['district_id' => $b->id, 'name' => 'Upazila B1', 'code' => 'B1']);
        Upazila::create(['district_id' => $b->id, 'name' => 'Upazila B2', 'code' => 'B2']);
        Upazila::create(['district_id' => $c->id, 'name' => 'Upazila C1', 'code' => 'C1']);
        // Add more upazilas as needed...
    }
}
