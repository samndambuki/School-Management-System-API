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
        Schema::create('course_teacher', function (Blueprint $table) {
            $table->uuid('id')->primary();
            //foreign key referencing courses.id
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade');
            //foreign key referencing teachrers.id
            $table->foreignUuid('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_teacher');
    }
};
