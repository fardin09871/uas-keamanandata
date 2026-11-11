<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $t) {
            $t->id();
            $t->text('data');         // AES-256-GCM: base64(iv|tag|ciphertext)
            $t->text('wrapped_key');  // kunci AES dibungkus RSA-OAEP
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('donations'); }
};
