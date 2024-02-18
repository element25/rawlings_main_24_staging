<?php

namespace App\Filament\Resources\HomepageHeroResource\Pages;

use App\Filament\Resources\HomepageHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomepageHero extends EditRecord
{
    protected static string $resource = HomepageHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
