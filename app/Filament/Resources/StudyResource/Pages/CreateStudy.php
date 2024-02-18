<?php

namespace App\Filament\Resources\StudyResource\Pages;

use App\Enums\StudyStatus;
use App\Filament\Resources\StudyResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateStudy extends CreateRecord
{
    protected static string $resource = StudyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Case Study created';
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
            $data['status'] = StudyStatus::PUBLISHED;
        }
        if ($data['published_at'] > Carbon::today()) {
            $data['status'] = StudyStatus::SCHEDULED;
        }

        return $data;
    }
}
