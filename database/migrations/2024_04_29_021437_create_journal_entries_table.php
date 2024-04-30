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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('jur_code');
            $table->string('account_id');
            $table->foreign('jur_code')->references('journal_code')->on('journal_accounts')->cascadeOnDelete();
            $table->foreign('account_id')->references('code')->on('chartof_accounts')->cascadeOnDelete();
            $table->string('description');
            $table->float('credit');
            $table->float('debit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
