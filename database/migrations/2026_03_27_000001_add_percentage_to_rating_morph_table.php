<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
        if (! Schema::hasTable('rating_morph')) {
            return;
        }

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
        Schema::table('rating_morph', function (Blueprint $table) {
            if (! Schema::hasColumn('rating_morph', 'percentage')) {
                $table->decimal('percentage', 10, 3)->nullable()->after('value')->comment('Percentuale calcolata per il rating');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rating_morph', function (Blueprint $table) {
            if (Schema::hasColumn('rating_morph', 'percentage')) {
                $table->dropColumn('percentage');
            }
        });
    }
};
