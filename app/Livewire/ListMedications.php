<?php

namespace App\Livewire;

use App\Models\Medications;
use App\Services\MedicationForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Livewire\Component;
use Illuminate\Support\Str;

class ListMedications extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.list-medications');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Medications::query())
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('dosage')
                    ->formatStateUsing(function (Medications $record) {
                        return $record->dosage . ' ' . ucfirst(Str::plural($record->type, $record->dosage)) . ' every ' . $record->interval;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(MedicationForm::schema()),
                Tables\Actions\DeleteAction::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Medications::class)
                    ->form(MedicationForm::schema())
            ]);
    }
}
