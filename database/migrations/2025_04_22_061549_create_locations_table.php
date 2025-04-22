<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
Schema::create('locations', function (Blueprint $table) {
$table->id();
$table->foreignId('division_id')->constrained();
$table->foreignId('district_id')->constrained();
$table->foreignId('upazila_id')->constrained();
$table->timestamps();
});
