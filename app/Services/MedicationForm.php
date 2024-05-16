<?php

namespace App\Services;

use Filament\Forms;

final class MedicationForm
{
    public static function schema(): array
    {
        $intervalOptions = [
            'Day' => 'Day',
        ];

        for ($day = 2; $day <= 31; $day++) {
            $intervalOptions["$day Days"] = "$day Days";
        }

        return [
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('dosage')
                        ->required()
                        ->numeric(),
                    Forms\Components\Select::make('type')
                        ->required()
                        ->native(false)
                        ->options([
                            'tablet' => 'Tablet',
                            'capsule' => 'Capsule',
                            'injectable' => 'Injectable',
                        ]),
                    Forms\Components\Select::make('interval')
                        ->required()
                        ->prefix('Every')
                        ->searchable()
                        ->options($intervalOptions),
                ])
        ];
    }
}
