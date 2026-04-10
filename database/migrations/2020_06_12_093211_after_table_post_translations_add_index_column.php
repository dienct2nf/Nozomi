<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AfterTablePostTranslationsAddIndexColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_translations', function (Blueprint $table) {
           DB::statement('ALTER TABLE post_translations ADD FULLTEXT `search` (`title`, `content`)');
           DB::statement('ALTER TABLE post_translations ENGINE = InnoDB'); // đánh index theo kiểu MyISam ngoài ra còn có kiểu InnoDB
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_translations', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE post_translations DROP INDEX title');
            DB::statement('ALTER TABLE post_translations DROP INDEX content');
        });
    }
}
