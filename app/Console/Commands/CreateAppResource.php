<?php

namespace Catering\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CreateAppResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-resource {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Resource with a Migration, Model, Seeder, Factory, Request, Resource and Controller ';

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
        $moduleName = $this->argument('module');
        $tableName = Str::snake($moduleName);
        dd($tableName);
        $this->info('Creating Migation');
        Artisan::call("make:migration create_table_{$tableName}s --create={$tableName}s");

        $this->info('Creating TableSeeder');
        Artisan::call("make:seeder {$moduleName}TableSeeder ");

        $this->info('Creating Model');
        Artisan::call("make:model Models/{$moduleName}");

        $this->info('Creating Factory');
        Artisan::call("make:factory {$moduleName}Factory --model=Models/{$moduleName}");

        $this->info("Creating Request");
        Artisan::call("make:request {$moduleName}Request");

        $this->info("Creating Resource");
        Artisan::call("make:resource {$moduleName}Resource");

        $this->info("Creating Controller");
        Artisan::call("make:controller {$moduleName}Controller --api");
    }
}
