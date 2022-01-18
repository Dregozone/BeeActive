<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSharedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shared_logs', function (Blueprint $table) {
            $table->string('project');
            $table->string('username');
            $table->string('environment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shared_logs', function (Blueprint $table) {
            $table->dropColumn('project');
            $table->dropColumn('username');
            $table->dropColumn('environment');
        });
    }
}
