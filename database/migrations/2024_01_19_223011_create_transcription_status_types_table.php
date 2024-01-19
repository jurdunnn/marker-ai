<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transcription_status_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Add Pending, Processing, and Complete status types
        DB::insert('insert into transcription_status_types (name) values (?)', ['Pending']);
        DB::insert('insert into transcription_status_types (name) values (?)', ['Processing']);
        DB::insert('insert into transcription_status_types (name) values (?)', ['Complete']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transcription_status_types');
    }
};
