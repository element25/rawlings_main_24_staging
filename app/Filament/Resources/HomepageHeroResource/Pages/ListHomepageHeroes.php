<?php

namespace App\Filament\Resources\HomepageHeroResource\Pages;

use App\Filament\Resources\HomepageHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomepageHeroes extends ListRecords
{
    protected static string $resource = HomepageHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
