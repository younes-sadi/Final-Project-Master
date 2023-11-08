<?php

namespace App\Filament\Resources\SeasonResource\Widgets;

use Carbon\Carbon;
use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ParametrePlant extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    public ?Model $record = null;

    public function mount(Model $record)
    {
        $this->record = $record;
    }

    protected function getCards(): array
    {
        $plant = $this->record->plant;
        $date_start  =  $this->record->start_day;
        $today = Carbon::today();
        $date = Carbon::createFromFormat('Y-m-d 00:00:00', $date_start);
        $daysDifference = $today->diffInDays($date);
        $weeks = Carbon::now()->addDays($daysDifference)->diffInWeeks();
        $num = ''.$weeks;
        $num = substr($num, 0, 1);




        $duree_floration = $plant->duree_floration;
        $duree_nouaison = $plant->duree_nouaison;
        $duree_debut_recolte = $plant->duree_debut_recolte;
        $duree_fin_recorte = $plant->duree_fin_recorte;
        $fin_flortion = $duree_floration+$duree_floration;
        $fin_nouason = $duree_floration+$duree_floration+$plant->duree_nouaison;
        $fin_d_r = $duree_floration+$duree_floration+$plant->duree_nouaison+$plant->duree_debut_recolte;
        $fin_f_r = $duree_floration+$duree_floration+$plant->duree_nouaison+$plant->duree_debut_recolte+$plant->duree_fin_recorte;
        if($num<=2){
$debut = 'success';
        }else{
            $debut = 'danger';
        }
        if($num>2 AND $num<=$fin_flortion){
            $debut_flo = 'success';
                    }else{
                        $debut_flo = 'danger';
                    }
                    if($num>$fin_flortion AND $num<=$fin_nouason){
                        $debut_noi = 'success';
                                }else{
                                    $debut_noi = 'danger';
                                }
                                if($num>$fin_nouason AND $num<=$fin_d_r){
                                    $debut_d_rec = 'success';
                                            }else{
                                                $debut_d_rec = 'danger';
                                            }
                                            if($num>$fin_d_r AND $num<=$fin_f_r){
                                                $debut_f_rec = 'success';
                                                        }else{
                                                            $debut_f_rec = 'danger';
                                                        }

        return [
            Card::make('Current Week',$weeks),
            Card::make('','Seed')->description("week")->color($debut),
            Card::make('Floration','Sprout')->description('From 2'.' To  '.$fin_flortion.' Week')->color($debut_flo),
            Card::make('Nouaison','Seeding')->description('From '.$fin_flortion.' To  '.$fin_nouason.' Week')->color($debut_noi),
            Card::make('Debut Recolte','Mature Plant')->description('From '.$fin_nouason.' To  '.$fin_d_r.' Week')->color($debut_d_rec),
            Card::make('Fin Recolte','Plant with fruits')->description('From '.$fin_d_r.' To  '.$fin_f_r.' Week')->color($debut_f_rec),


        ];
    }
}
