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
    protected $signature = 'db:mysqldump {database_name} {password}';

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
        $schema = $this->argument('database_name'); //your database name
        $password = $this->argument('password'); //your database password
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds;
        $file = date('d-m-Y') . '_mysqldump.sql';
        $command = sprintf('mysqldump %s -u raiyan -p\'%s\' > %s', $schema, $password, $path . $file);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command);
    }
}
