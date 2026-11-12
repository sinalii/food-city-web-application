<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('phone', 20)->nullable()->unique();
            $table->timestamp('phone_verified_at')->nullable();
        });

        Schema::create('registration_otps', function (Blueprint $table) {
            $table->id();
            $table->string('destination')->unique();
            $table->string('channel', 10);
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('password_hash');
            $table->string('code_hash');
            $table->timestamp('expires_at')->index();
            $table->timestamp('last_sent_at');
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->unsignedTinyInteger('resends')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && DB::table('users')->whereNull('email')->exists()) {
            throw new RuntimeException('Cannot reverse OTP registration while phone-only accounts exist.');
        }

        Schema::dropIfExists('registration_otps');

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone']);
            $table->dropColumn(['phone', 'phone_verified_at']);
            $table->string('email')->nullable(false)->change();
        });
    }
};
