<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->string('spei')->nullable();
            $table->text('file_comprobante')->nullable();
            $table->dropColumn('total');
            $table->dropColumn('adeudo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropColumn('spei');
            $table->dropColumn('file_comprobante');
            $table->decimal('adeudo',8,2);
            $table->decimal('total', 8, 2);
        });
    }
}
