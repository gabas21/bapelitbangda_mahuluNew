<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_stats', function (Blueprint $table) {
            $table->id();
            $table->string('doc_key')->unique(); // e.g. "regulasi_permendagri-86-2017"
            $table->string('type');              // "regulasi" or "dokumen"
            $table->string('category');          // e.g. "peraturan-menteri"
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_stats');
    }
};
