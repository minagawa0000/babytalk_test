<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Flynsarmy\CsvSeeder\CsvSeeder;

class BabyageScopeSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'babyage_scopes';
        $this->filename = base_path().'/database/seeders/csv/babyage_scope.csv';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
