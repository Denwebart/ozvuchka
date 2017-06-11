<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FunctionStripTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::unprepared(
		    "
			CREATE FUNCTION strip_tags( Dirty varchar(10000) )
			RETURNS varchar(10000)
			DETERMINISTIC
			BEGIN
			  DECLARE iStart, iEnd, iLength int;
			    WHILE Locate( '<', Dirty ) > 0 And Locate( '>', Dirty, Locate( '<', Dirty )) > 0 DO
			      BEGIN
			        SET iStart = Locate( '<', Dirty ), iEnd = Locate( '>', Dirty, Locate('<', Dirty ));
			        SET iLength = ( iEnd - iStart) + 1;
			        IF iLength > 0 THEN
			          BEGIN
			            SET Dirty = Insert( Dirty, iStart, iLength, '');
			          END;
			        END IF;
			      END;
			    END WHILE;
			    RETURN Dirty;
			END;
			"
	    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::unprepared(
	    	"DROP FUNCTION IF EXISTS strip_tags;"
	    );
    }
}
