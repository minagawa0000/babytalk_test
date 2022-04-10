<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Flynsarmy\CsvSeeder\CsvSeeder;
class PrefectureSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'prefectures';
        $this->filename = base_path().'/database/seeders/csv/todouhuken.csv';
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
