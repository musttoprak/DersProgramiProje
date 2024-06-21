<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirimIdToDersprogramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dersprogram', function (Blueprint $table) {
            $table->unsignedBigInteger('birimId')->after('sinifId'); // 'sinifId' sütunundan sonra eklenecek
            $table->foreign('birimId')->references('birimId')->on('birimler'); // 'birimler' tablosundaki 'birimId' ile ilişkilendirilecek
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dersprogram', function (Blueprint $table) {
            $table->dropForeign(['birimId']); // İlişkiyi kaldır
            $table->dropColumn('birimId'); // Sütunu kaldır
        });
    }
}
