<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            $perfil_id = auth()->user()->perfil_id;
            $telasSemModulo = DB::table('perfis_telas')
                ->join("telas", "perfis_telas.tela_id", "=", "telas.id")
                ->where(["perfis_telas.perfil_id" => $perfil_id, "telas.menu" => 1, "telas.modulo_id" => null])
                ->orderBy("telas.ordem", "asc")
                ->get();

            $event->menu->add('MENU');

            foreach($telasSemModulo as $tela) {
                $event->menu->add([
                    'text' => $tela->nome,
                    'url' => route($tela->rota),
                    'icon' => $tela->icone
                ]);
            }

            $modulosPerfil = DB::table('perfis_telas')
                ->select("modulos.id", "modulos.nome", "modulos.icone")
                ->join("telas", "perfis_telas.tela_id", "=", "telas.id")
                ->join("modulos", "telas.modulo_id", "=", "modulos.id")
                ->where("perfis_telas.perfil_id", $perfil_id)
                ->where("telas.menu", true)
                ->where("telas.modulo_id", "<>", null)
                ->groupBy("modulos.id", "modulos.nome", "modulos.icone")
                ->orderBy("modulos.ordem", "asc")
                ->get();

            foreach($modulosPerfil as $modulo) {

                $submenu = [];
                $telasModulo = DB::table('perfis_telas')
                    ->join("telas", "perfis_telas.tela_id", "=", "telas.id")
                    ->where(["perfis_telas.perfil_id" => $perfil_id, "telas.menu" => true, "telas.modulo_id" => $modulo->id])
                    ->orderBy("telas.ordem", "asc")
                    ->get();

                foreach($telasModulo as $tela) {
                    array_push($submenu, [
                        'text' => $tela->nome,
                        'url' => route($tela->rota),
                        'icon' => $tela->icone ?? 'far fa-circle'
                    ]);
                }

                $event->menu->add([
                    'text'    => $modulo->nome,
                    'icon'    => $modulo->icone ?? 'fas fa-fw fa-share',
                    'submenu' => $submenu
                ]);
            }
        });
    }
}
