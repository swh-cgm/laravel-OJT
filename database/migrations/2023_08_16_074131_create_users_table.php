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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100);
            $table->string('password', 255);
            $table->string('name', 100);
            $table->string('img', 255)->nullable();
            $table->integer('role')->comment('1 for admin. 2 for member');
            $table->integer('created_by')->comment('created user id')->nullable();
            $table->integer('updated_by')->comment('updated user id')->nullable();
            $table->string('remember_token ')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
