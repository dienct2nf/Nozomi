<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('slot');
            $table->string('workplace');
            $table->text('content');
            $table->decimal('price', 10, 2);
            $table->date('date', 10, 2);
            $table->string('img')->nullable();
            $table->integer('view_count')->default(0);
            $table->bigInteger('user_id');
            $table->string('slug');
            $table->enum('status', ['enable', 'disable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
