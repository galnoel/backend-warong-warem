<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained(
                    table: 'users',
                    indexName: 'reservation_user_id'
                )
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('table_id')
                ->nullable()
                ->constrained(
                    table: 'tables',
                    indexName: 'reservation_table_id'
                )
                ->onUpdate('cascade')
                ->onDelete('set null');
            
            $table->string('status');
            $table->integer('number_of_people');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
