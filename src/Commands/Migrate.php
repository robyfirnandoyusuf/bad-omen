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
        $dir = '/var/www/html/portal-dikti/database/migrations';
        // $files = glob("$dir/*_create_*_table.php");

        $files = glob("$dir/*_create_*_table.php");

        foreach ($files as $file) {
            $baseName = pathinfo($file, PATHINFO_FILENAME);
            $cmig = DB::table('migrations')->where('migration', $baseName)->count();
            
            if ($cmig <= 0) {
                echo "$baseName - Does not exist in migrations table\n";

                DB::table('migrations')->insert(
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

