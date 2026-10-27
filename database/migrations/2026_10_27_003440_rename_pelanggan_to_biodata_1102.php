<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename(
            'pelanggan',
            'biodata_1102'
        );
    }

    public function down(): void
    {
        Schema::rename(
            'biodata_1102',
            'pelanggan'
        );
    }
};
