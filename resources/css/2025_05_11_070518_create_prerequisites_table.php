<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('prerequisites', function (Blueprint $table) {
        $table->id();
        $table->string('prerequisite_name');
        $table->string('prerequisite_type');
        $table->unsignedBigInteger('category_id')->nullable(); // optional category
        $table->timestamps(); // this adds created_at and updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prerequisites');
    }
};
