<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Devices;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Widgets\DevicesStatsOverview;
use App\Filament\Resources\DevicesResource\Pages;
use App\Filament\Resources\DevicesResource\RelationManagers;
use App\Filament\Resources\DevicesResource\Pages\ListDevices;
use App\Filament\Resources\DevicesResource\Pages\CreateDevices;

class DevicesResource extends Resource
{
    protected static ?string $model = Devices::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Devices';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card::make()->schema([
                //     TextInput::make("name")->maxLength(100)->nullable(false),
                //     Select::make('works')->options([
                //         false=>"OFF",
                //         true=>"ON",
                //     ])->label("ON/OFF")->nullable(false)
                // ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season.name')->label("Season Name"),
                BooleanColumn::make('fan')->label("FAN"),
                BooleanColumn::make('pump')->label("PUMP"),
                BooleanColumn::make('led')->label("LED"),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('fan')->label("FAN")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('pump')->label("PUMP")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('led')->label("LED")
                ->options([
                    true => 'ON',
                    false=>'OFF'
                ]),
                Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from'),
                    Forms\Components\DatePicker::make('created_until'),
                    Forms\Components\Checkbox::make('Today'),
                    Forms\Components\Checkbox::make('Last Week'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        $endOfWeek = $endOfWeek->addDay(1);
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        )->when(
                            $data['Today'],
                            fn (Builder $query): Builder => $query->whereDate('created_at',"=",Carbon::today()->toDateString()),
                        )->when(
                            $data['Last Week'],
                            fn (Builder $query): Builder => $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]),
                        );
                })


            ])
            ->actions([
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DevicesStatsOverview::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/'),
            // 'create' => Pages\CreateDevices::route('/create'),
        ];
    }
}
