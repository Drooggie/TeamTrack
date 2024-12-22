<?php

use App\Models\Department;
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
        Schema::disableForeignKeyConstraints();

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('full_name', 100);
            $table->string('email', 100)->unique()->index();
            $table->foreignIdFor(Department::class)->constrained()->cascadeOnDelete();
            $table->string('job_title', 50);
            $table->string('payment_type', 20);
            $table->unsignedInteger('salary')->nullable();
            $table->unsignedInteger('hourly_rate')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
