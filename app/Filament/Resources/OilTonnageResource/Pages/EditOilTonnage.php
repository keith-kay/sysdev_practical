<?php

namespace App\Filament\Resources\OilTonnageResource\Pages;

use App\Filament\Resources\OilTonnageResource;
use App\Models\vcf;
use Filament\Notifications\Notification;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOilTonnage extends EditRecord
{
    protected static string $resource = OilTonnageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function calculateTonnage()
    {
        $state = $this->form->getState();

        $volume = $state['volume'] ?? 0;
        $density = $state['density'] ?? 0;
        $temperature = $state['temperature'] ?? 0;

        $roundedDensity = round($density * 2) / 2;      // Round to nearest 0.5
        $roundedTemp = round($temperature * 4) / 4;     // Round to nearest 0.25

        $vcfRow = vcf::where('density', $roundedDensity)
            ->where('temperature', $roundedTemp)
            ->first();

        if (!$vcfRow) {
            Notification::make()
                ->title('VCF not found for the given density and temperature.')
                ->danger()
                ->send();
            return;
        }

        $vcf = $vcfRow->vcf;
        $tonnage = ($volume * $density * $vcf) / 1000;

        $this->form->fill([
            'volume' => $volume,
            'density' => $density,
            'temperature' => $temperature,
            'vcf' => $vcf,
            'tonnage' => round($tonnage, 3),
        ]);

        Notification::make()
            ->title('Tonnage calculated successfully.')
            ->success()
            ->send();
    }
}
