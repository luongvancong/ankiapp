<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\User\Repositories\Chmod\Permission;

class SyncPermissionFromConfigToDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync permissions to database';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info("Start sync");
        $defaultPermissions = config('permissions');

        foreach ($defaultPermissions as $perm) {
            Permission::updateOrCreate([
                'name' => $perm['name']
            ], $perm);
        }

        $this->info("Finish sync");
    }
}
