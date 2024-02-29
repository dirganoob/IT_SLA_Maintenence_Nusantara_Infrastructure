<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalselesaiToJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::table('jadwals', function (Blueprint $table) {
    //         //
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::table('jadwals', function (Blueprint $table) {
    //         //
    //     });
    // }
    public function up()
{
    Schema::table('jadwals', function (Blueprint $table) {
        $table->date('tanggalselesai')->after('tanggalkegiatan')->nullable();
    });
}

public function down()
{
    Schema::table('jadwals', function (Blueprint $table) {
        $table->dropColumn('tanggalselesai');
    });
}

}
