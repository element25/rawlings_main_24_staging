<?php

namespace App\Filament\Resources\StudyCategoryResource\Pages;

use App\Filament\Resources\StudyCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudyCategory extends EditRecord
{
    protected static string $resource = StudyCategoryResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
