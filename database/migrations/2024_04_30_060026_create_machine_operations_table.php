<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineOperationsTable extends Migration
{
    public function up()
    {
        Schema::create('machine_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_id')->constrained('machine_data')->onDelete('cascade');
            $table->string('year');
            $table->string('month');
            $table->string('week');
            $table->string('day');
            $table->string('code');
            $table->string('time');
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('current_line');
            $table->boolean('is_changed')->default(false);
            $table->string('changed_by')->default('None');
            $table->timestamp('change_date')->default(now());
            $table->boolean('is_approved')->default(false);
            $table->string('approved_by')->default('None');
            $table->boolean('is_rejected')->default(false);
            $table->string('rejected_by')->default('None');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('machine_operations');
    }
}
