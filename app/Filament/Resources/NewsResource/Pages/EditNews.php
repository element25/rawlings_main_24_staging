<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Enums\NewsStatus;
use App\Filament\Resources\NewsResource;
use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

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

    protected function getSavedNotificationTitle(): ?string
    {
        return 'News Article updated';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        ray($data);
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
        //        ray($data);

        return $data;
    }

    //    protected function handleRecordUpdate(Model $record, array $data): Model
    //    {
    //        $logo_html = $record->getFirstMedia('image_index')->toHtml();
    //        $data['logo_html'] = $logo_html;
    //
    //        $record->update($data);
    //
    //        return $record;
    //    }
}
