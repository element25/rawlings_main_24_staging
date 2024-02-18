<?php

namespace App\Filament\Resources\StudyResource\Pages;

use App\Enums\StudyStatus;
use App\Filament\Resources\StudyResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditStudy extends EditRecord
{
    protected static string $resource = StudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Case Study updated';
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
        //        ray($data);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $logo_html = $record->getFirstMedia('studies_our_work')->toHtml();
        $data['logo_html'] = $logo_html;

        $record->update($data);

        return $record;
    }
}
