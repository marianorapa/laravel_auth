<?php

namespace App\Providers;

use App\Observers\DevolucionObserver;
use App\Observers\OrdenProduccionDetalleNoTrazableObserver;
use App\Observers\OrdenProduccionDetalleTrazableObserver;
use App\Observers\TicketEntradaObserver;
use App\Observers\TicketObserver;
use App\OrdenProduccionDetalleNoTrazable;
use App\OrdenProduccionDetalleTrazable;
use App\PrestamoDevolucion;
use App\Ticket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);

        /*Register observers*/
        Ticket::observe(TicketObserver::class);
        PrestamoDevolucion::observe(DevolucionObserver::class);
        OrdenProduccionDetalleNoTrazable::observe(OrdenProduccionDetalleNoTrazableObserver::class);
        OrdenProduccionDetalleTrazable::observe(OrdenProduccionDetalleTrazableObserver::class);
    }
}
