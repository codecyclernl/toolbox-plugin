<?php namespace Codecycler\Toolbox\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTagsTable extends Migration
{
    public function up()
    {
        Schema::table('codecycler_toolbox_tags', function (Blueprint $table) {
            $table->string('code');
        });
    }

    public function down()
    {
        Schema::table('codecycler_toolbox_tags', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
}