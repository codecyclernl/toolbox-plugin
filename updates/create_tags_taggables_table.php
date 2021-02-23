<?php namespace Codecycler\Toolbox\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTagsTaggablesTable extends Migration
{
    public function up()
    {
        Schema::create('codecycler_toolbox_tags_taggables', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('tag_id');
            $table->integer('taggable_id');
            $table->string('taggable_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('codecycler_toolbox_tags_taggables');
    }
}
