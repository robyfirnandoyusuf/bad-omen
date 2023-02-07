<?php

namespace Robyfirnandoyusuf\BadOmen\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Migrate extends Command {
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badomen:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start bad omen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dir = database_path('migrations');
        $files = array_values(array_diff(scandir($dir), array('..', '.')));

        foreach ($files as $file) {
            $baseName = pathinfo($file, PATHINFO_FILENAME);
            preg_match('/\'(.*)\'/', file_get_contents("$dir/$file"), $match);

            $tbName = $match[1];

            // $cmig = DB::table(env('DB_SCHEMA').'.testxx')->where('migration', $baseName)->count();

            $cmig = DB::table(env('DB_SCHEMA').'.migrations')->where('migration', $baseName)->count();
            
            $tbExists = DB::select("
                SELECT EXISTS(
                    SELECT * 
                    FROM information_schema.tables 
                    WHERE 
                    table_schema = '".env('DB_SCHEMA')."' AND 
                    table_name = '{$tbName}'
                );
            ");

            if ($cmig <= 0 && $tbExists[0]->exists == true) {
                echo "$baseName - Does not exist in migrations table\n";

                DB::table(env('DB_SCHEMA').'.migrations')->insert(
                    [
                        'migration' => $baseName,
                        'batch' => 1
                    ]
                );
                echo "$baseName - Insert successfully !\n";
            }
        }

        echo "DONE !\n";
        return 0;
    }

}

