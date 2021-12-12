<?php

use App\Models\Textblock;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextblockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textblocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->nullable()->unique();
            $table->string('title');
            Textblock::statusColumn($table);
            Textblock::positionColumn($table);
            $table->timestamps();
        });

        Schema::create('textblock_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('textblock_id')->unsigned();
            $table->string('locale')->index();

            $table->text('text')->nullable();

            $table->unique(['textblock_id','locale']);
            $table->foreign('textblock_id')->references('id')->on('textblocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('textblock_translations');
        Schema::dropIfExists('textblocks');
    }
}
