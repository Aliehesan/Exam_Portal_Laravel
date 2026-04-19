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
        Schema::table('user_answers', function (Blueprint $column) {
            $column->unsignedBigInteger('exam_result_id')->nullable()->after('exam_id');
            $column->foreign('exam_result_id')->references('id')->on('exam_results')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_answers', function (Blueprint $column) {
            $column->dropForeign(['exam_result_id']);
            $column->dropColumn('exam_result_id');
        });
    }
};
