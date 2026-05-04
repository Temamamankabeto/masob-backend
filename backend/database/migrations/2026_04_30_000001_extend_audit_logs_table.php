<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('actor_id')->nullable();
                $table->string('action')->nullable();
                $table->string('module')->nullable();
                $table->string('target_type')->nullable();
                $table->unsignedBigInteger('target_id')->nullable();
                $table->text('description')->nullable();
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->json('before')->nullable();
                $table->json('after')->nullable();
                $table->json('changes')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('audit_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('audit_logs', 'actor_id')) {
                $table->unsignedBigInteger('actor_id')->nullable()->after('id');
            }

            if (!Schema::hasColumn('audit_logs', 'action')) {
                $table->string('action')->nullable()->after('actor_id');
            }

            if (!Schema::hasColumn('audit_logs', 'module')) {
                $table->string('module')->nullable()->after('action');
            }

            if (!Schema::hasColumn('audit_logs', 'target_type')) {
                $table->string('target_type')->nullable()->after('module');
            }

            if (!Schema::hasColumn('audit_logs', 'target_id')) {
                $table->unsignedBigInteger('target_id')->nullable()->after('target_type');
            }

            if (!Schema::hasColumn('audit_logs', 'description')) {
                $table->text('description')->nullable()->after('target_id');
            }

            if (!Schema::hasColumn('audit_logs', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('description');
            }

            if (!Schema::hasColumn('audit_logs', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }

            if (!Schema::hasColumn('audit_logs', 'before')) {
                $table->json('before')->nullable()->after('user_agent');
            }

            if (!Schema::hasColumn('audit_logs', 'after')) {
                $table->json('after')->nullable()->after('before');
            }

            if (!Schema::hasColumn('audit_logs', 'changes')) {
                $table->json('changes')->nullable()->after('after');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
