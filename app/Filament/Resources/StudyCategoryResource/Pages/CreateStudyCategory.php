<?php

namespace App\Filament\Resources\StudyCategoryResource\Pages;

use App\Filament\Resources\StudyCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudyCategory extends CreateRecord
{
    protected static string $resource = StudyCategoryResource::class;

    protected function getActions(): array
    {
        return [

        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
