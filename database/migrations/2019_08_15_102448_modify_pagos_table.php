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
        });
    }
}
