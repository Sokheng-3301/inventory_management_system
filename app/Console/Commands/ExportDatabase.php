<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportDatabase extends Command
{
    protected $signature = 'db:export {filename}';
    protected $description = 'Export the database to an SQL file';

    public function handle()
    {
        $filename = $this->argument('filename');
        $path = storage_path($filename);

        // Get all tables
        $tables = DB::select('SHOW TABLES');
        $sql = '';

        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_" . env('DB_DATABASE')};
            $sql .= "DROP TABLE IF EXISTS `$tableName`;\n";
            
            $createTable = DB::select("SHOW CREATE TABLE `$tableName`");
            $sql .= $createTable[0]->{'Create Table'} . ";\n\n";

            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $values = implode("', '", array_values((array) $row));
                $sql .= "INSERT INTO `$tableName` VALUES ('$values');\n";
            }
            $sql .= "\n";
        }

        File::put($path, $sql);
        $this->info("Database exported to {$path}");
    }
}