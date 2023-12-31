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
        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign('posts_created_by_foreign');
            $table->dropForeign('posts_updated_by_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function(Blueprint $table){
            $table->foreign('created_by')->references('id')->on('users')->change();
            $table->foreign('updated_by')->references('id')->on('users')->change();
        });
    }
};
