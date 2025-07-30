<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable(); // ringkasan
            $table->text('content')->nullable(); // isi lengkap
            $table->string('image_url')->nullable(); // gambar utama
            $table->string('link')->nullable(); // jika berita diambil dari luar
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('beritas');
        
    }
    
};
