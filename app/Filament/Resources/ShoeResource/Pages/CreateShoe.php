<?php

namespace App\Filament\Resources\ShoeResource\Pages;

use App\Filament\Resources\ShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Model;

class CreateShoe extends CreateRecord
{
    protected static string $resource = ShoeResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);
        Artisan::call('sync:public-storage');
        return $record;
    }
}
