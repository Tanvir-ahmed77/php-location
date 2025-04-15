<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->string('code', 10)->unique(); // A1, B2, etc.
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('district_id'); // Add index for better performance
        });
    }

    public function down()
    {
        Schema::dropIfExists('upazilas');
    }
};
