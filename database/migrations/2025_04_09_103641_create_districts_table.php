<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->string('code', 10)->unique();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('division_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('districts');
    }
};
