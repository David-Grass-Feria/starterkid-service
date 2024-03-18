<?php

namespace GrassFeria\StarterkidService\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use GrassFeria\StarterkidService\Console\Commands\InstallStarterkidServiceCommand;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->mergeConfigFrom(
            __DIR__.'/../../config/starterkid-service.php', 'starterkid-service'
        );
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
      
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'starterkid-service');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../../lang');
        Livewire::component('starterkid-service::service-create',\GrassFeria\StarterkidService\Livewire\Service\ServiceCreate::class);
        Livewire::component('starterkid-service::service-edit',\GrassFeria\StarterkidService\Livewire\Service\ServiceEdit::class);
        Livewire::component('starterkid-service::service-index',\GrassFeria\StarterkidService\Livewire\Service\ServiceIndex::class);

        Livewire::component('starterkid-service::front-service-index',\GrassFeria\StarterkidService\Livewire\Front\Service\FrontServiceIndex::class);
        Livewire::component('starterkid-service::front-service-show',\GrassFeria\StarterkidService\Livewire\Front\Service\FrontServiceShow::class);
       
        $this->publishes([
            __DIR__.'/../../stubs' => base_path('/'),
        ], 'starterkid-service');



        // commands
        $this->commands([
            InstallStarterkidServiceCommand::class,
            
        ]);

        // scheduler
        //$this->app->booted(function () {
        //    $schedule = $this->app->make(Schedule::class);
        //    $schedule->command('backup:run')->everyFiveMinutes();
        //    
        //});

        

        $this->app->config->set('filesystems.disks.ckimage', [
            'driver' => 'local',
            'root' => storage_path('app/public/ckimages'),
            'url' => env('APP_URL').'/storage/ckimages',
            'visibility' => 'public',
            'throw' => false,
           ]);
        


       
    }
}