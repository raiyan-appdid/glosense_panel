<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MySqlDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:mysqldump {schema} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the mysqldump utility';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;

        $schema = $this->argument('schema');
        $password = $this->argument('password');
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds;
        $file = date('Y-m-d') . '_mysqldump.sql';
        $command = sprintf('mysqldump %s -u forge -p\'%s\' > %s', $schema, $password, $path . $file);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command);
    }
}
