<?php

namespace App\Filament\Resources\StudyCategoryResource\Pages;

use App\Filament\Resources\StudyCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudyCategories extends ListRecords
{
    protected static string $resource = StudyCategoryResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
