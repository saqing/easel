<?php

namespace Canvas\Helpers;

use Schema;
use Canvas\Models\Settings;
use Illuminate\Support\Facades\File;

class SetupHelper extends CanvasHelper
{
    /**
     * Ensure all required tables exist;.
     */
    public static function requiredTablesExists()
    {
        $requiredTables = array_merge(self::REQUIRED_TABLES, [
            self::TABLES['users'],
            self::TABLES['settings'],
        ]);

        foreach ($requiredTables as $table) {
            if (! Schema::hasTable($table)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Whether canvas is properly set up/installed.
     * @return bool
     */
    public static function isSetUp()
    {
        return Settings::installed() && self::requiredTablesExists();
    }

    /**
     * Whether canvas is properly installed.
     * @return bool
     */
    public static function isInstalled()
    {
        return File::exists(storage_path(CanvasHelper::INSTALLED_FILE));
    }

    public static function installedBanner()
    {
        return PHP_EOL.'   ######       ##      ####     ##  ##      ##   ##       ########
  ##////##     ####    /##/##   /## /##     /##  ####     ##////// 
 ##    //     ##//##   /##//##  /## /##     /## ##//##   /##       
/##          ##  //##  /## //## /## //##    ## ##  //##  /#########
/##         ########## /##  //##/##  //##  ## ########## ////////##
//##    ## /##//////## /##   //####   //#### /##//////##        /##
 //######  /##     /## /##    //###    //##  /##     /##  ######## 
  //////   //      //  //      ///      //   //      //  ////////'.PHP_EOL;
    }
}
