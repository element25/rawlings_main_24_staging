<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Enums\NewsStatus;
use App\Filament\Resources\NewsResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'News Article created';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['original_slug']);

        if ($data['published_at']) {
            $data['published_at'] = Carbon::createFromFormat('d/m/Y', $data['published_at'])->format('Y-m-d 00:00:00');
        } else {
            $data['published_at'] = null;
        }

        //        ray(Carbon::today());
        if ($data['published_at'] == Carbon::today()) {
            $data['status'] = NewsStatus::PUBLISHED;
        }
        if ($data['published_at'] > Carbon::today()) {
            $data['status'] = NewsStatus::SCHEDULED;
        }

        return $data;
    }
}
