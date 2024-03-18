<?php

namespace GrassFeria\StarterkidService\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\UniqueConstraintViolationException;

class InstallStarterkidServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkid-service:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the StarterkidService Plugin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
       
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('vendor:publish', ['--provider'=> 'GrassFeria\StarterkidService\Providers\AppServiceProvider','--force' => true]);
            
            //try {
            //Artisan::call('db:seed', ['class'=> 'GrassFeria\\StarterkidService\\Database\\Seeders\\ServiceSeeder']);
            //}catch(UniqueConstraintViolationException){
            //    $this->info('success');
            //}

            return $this->info('GREAT! StarterkidService INSTALLED..');
       
        
       
    }

    

    
}
