<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DebugSeeder extends Seeder
{
    public function run()
    {
        // List all tables
        $tables = DB::select('SHOW TABLES');
        echo "Current tables in database:\n";
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            echo "- $tableName\n";
            
            // Count records
            $count = DB::table($tableName)->count();
            echo "  Records: $count\n";
        }

        // Check services table specifically
        if (Schema::hasTable('services')) {
            echo "\nServices table exists!\n";
            $services = DB::table('services')->get();
            echo "Services count: " . count($services) . "\n";
        } else {
            echo "\nWARNING: services table does not exist!\n";
            
            // Check migrations
            if (Schema::hasTable('migrations')) {
                $migrations = DB::table('migrations')->where('migration', 'like', '%create_services%')->get();
                echo "\nRelated migrations:\n";
                foreach ($migrations as $migration) {
                    echo "- {$migration->migration} (Batch: {$migration->batch})\n";
                }
            }
        }
    }
}