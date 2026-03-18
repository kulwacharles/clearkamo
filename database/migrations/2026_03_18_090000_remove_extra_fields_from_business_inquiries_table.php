<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('business_inquiries')) {
            return;
        }

        $columns = [
            'job_title',
            'industry',
            'company_size',
            'website',
            'country',
            'city',
            'service_interest',
            'budget_range',
            'timeline',
            'challenge_details',
            'goals',
            'additional_details',
        ];

        $dropColumns = array_values(array_filter($columns, fn (string $column) => Schema::hasColumn('business_inquiries', $column)));

        if ($dropColumns === []) {
            return;
        }

        Schema::table('business_inquiries', function (Blueprint $table) use ($dropColumns) {
            $table->dropColumn($dropColumns);
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('business_inquiries')) {
            return;
        }

        Schema::table('business_inquiries', function (Blueprint $table) {
            if (!Schema::hasColumn('business_inquiries', 'job_title')) {
                $table->string('job_title')->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('business_inquiries', 'industry')) {
                $table->string('industry')->nullable()->after('job_title');
            }
            if (!Schema::hasColumn('business_inquiries', 'company_size')) {
                $table->string('company_size')->nullable()->after('industry');
            }
            if (!Schema::hasColumn('business_inquiries', 'website')) {
                $table->string('website')->nullable()->after('company_size');
            }
            if (!Schema::hasColumn('business_inquiries', 'country')) {
                $table->string('country')->nullable()->after('website');
            }
            if (!Schema::hasColumn('business_inquiries', 'city')) {
                $table->string('city')->nullable()->after('country');
            }
            if (!Schema::hasColumn('business_inquiries', 'service_interest')) {
                $table->string('service_interest')->nullable()->after('city');
            }
            if (!Schema::hasColumn('business_inquiries', 'budget_range')) {
                $table->string('budget_range')->nullable()->after('service_interest');
            }
            if (!Schema::hasColumn('business_inquiries', 'timeline')) {
                $table->string('timeline')->nullable()->after('budget_range');
            }
            if (!Schema::hasColumn('business_inquiries', 'challenge_details')) {
                $table->text('challenge_details')->nullable()->after('business_summary');
            }
            if (!Schema::hasColumn('business_inquiries', 'goals')) {
                $table->text('goals')->nullable()->after('challenge_details');
            }
            if (!Schema::hasColumn('business_inquiries', 'additional_details')) {
                $table->text('additional_details')->nullable()->after('goals');
            }
        });
    }
};

