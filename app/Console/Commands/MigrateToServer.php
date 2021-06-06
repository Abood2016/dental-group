<?php

namespace App\Console\Commands;

use App\Models\Presence;
use Illuminate\Console\Command;

class MigrateToServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this commands will migrate data to server';

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
        $presences = Presence::where("migrated",0)->get();
        foreach ($presences as $row){
            $row->migrated =1;
            $row->update();
        }
        $this->info('Successfully');

    }
}
