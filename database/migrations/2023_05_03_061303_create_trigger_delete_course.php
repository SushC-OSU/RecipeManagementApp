<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerDeleteCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER trigger_delete_course 
                    BEFORE DELETE ON courses 
                    FOR EACH ROW 
                    BEGIN
                        DECLARE recipes_count INT;
                        SELECT COUNT(*) INTO recipes_count FROM recipes WHERE course_id = OLD.id;
                        IF recipes_count > 0 THEN
                            SIGNAL SQLSTATE "45000"
                                SET MESSAGE_TEXT = "Cannot delete course because it is mapped with recipe(s)";
                        END IF;
                    END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_delete_course');

    }
}
