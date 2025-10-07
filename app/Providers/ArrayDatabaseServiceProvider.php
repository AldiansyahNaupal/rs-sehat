<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;

class ArrayDatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('db.connector.array', function () {
            return new class extends Connection {
                public function table($table, $as = null)
                {
                    return collect([]);
                }
            };
        });

        DB::extend('array', function ($config, $name) {
            return $this->app->make('db.connector.array');
        });
    }
}