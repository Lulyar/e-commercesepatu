<?php

namespace App\Filament\Resources\ShoeResource\Pages;

use App\Filament\Resources\ShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Model;

class EditShoe extends EditRecord
{
    protected static string $resource = ShoeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(
        Model $record,
        array $data
    ): Model {
        $result = parent::handleRecordUpdate($record, $data);
        Artisan::call('sync:public-storage');
        return $result;
    }
}
