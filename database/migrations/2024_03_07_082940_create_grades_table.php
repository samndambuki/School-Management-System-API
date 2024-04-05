<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('enrollment_id')->constrained('enrollments')->onDelete('cascade');
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignUuid('teacher_id')->constrained('teachers')->onDelete('cascade');
            //a decimal of 5 total digits and 2 decimal places
            $table->decimal('marks', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
