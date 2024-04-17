<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRecipeDietaryRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('recipe_dietary_restrictions', function (Blueprint $table) {
        //     $table->unsignedBigInteger('recipe_id')->after('id');
        //     $table->foreign('recipe_id')->references('id')->on('recipes');
        
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('recipe_dietary_restrictions', function (Blueprint $table) {
        //     $table->dropForeign(['recipe_id']);

        //     $table->dropColumn(['recipe_id']);
        // });
    }
}
