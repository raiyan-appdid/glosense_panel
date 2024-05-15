<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MySqlDumpBackupToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:mysqlbackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command excess the backup file created by db:mysqldump command and store that file into appdidZ digital ocean s3.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds . date('d-m-Y') . '_mysqldump.sql';
        if (file_exists($path)) {
            $content = File::get($path);
            $projectName = env('APP_NAME');
            $url =  Storage::disk('do')->put('mysql-backups/' . $projectName . '/' . date('M-Y') . '/' . date('d-M-Y') . '_backup.sql', $content, 'private');
            if ($url) {
                File::delete($path);
            }
        } else {
            \Log::info('file does not exists');
        }
        return Command::SUCCESS;
    }
}
