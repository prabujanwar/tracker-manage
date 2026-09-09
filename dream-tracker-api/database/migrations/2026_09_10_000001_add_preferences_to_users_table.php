<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('timezone')->default('UTC');
            $table->boolean('notifications_enabled')->default(true);
            $table->boolean('onboarding_completed')->default(false);
            $table->time('quiet_hours_start')->nullable();
            $table->time('quiet_hours_end')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'timezone',
                'notifications_enabled',
                'onboarding_completed',
                'quiet_hours_start',
                'quiet_hours_end',
            ]);
        });
    }
};
