<?php

namespace App\Providers;

use App\CapacidadProductiva;
use App\EstadoOpOrdenProduccion;
use App\MovimientoProductoTicketSalida;
use App\Observers\CapacidadProductivaObserver;
use App\Observers\DevolucionObserver;
use App\Observers\EstadoOpOrdenProduccionObserver;
use App\Observers\MovimientoProductoTicketSalidaObserver;
use App\Observers\OrdenProduccionDetalleNoTrazableObserver;
use App\Observers\OrdenProduccionDetalleTrazableObserver;
use App\Observers\OrdenProduccionObserver;
use App\Observers\TicketEntradaObserver;
use App\Observers\TicketObserver;
use App\OrdenProduccion;
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
        OrdenProduccion::observe(OrdenProduccionObserver::class);
        EstadoOpOrdenProduccion::observe(EstadoOpOrdenProduccionObserver::class);
        MovimientoProductoTicketSalida::observe(MovimientoProductoTicketSalidaObserver::class);
        CapacidadProductiva::observe(CapacidadProductivaObserver::class);
    }
}
