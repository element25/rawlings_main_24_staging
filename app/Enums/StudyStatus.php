<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StudyStatus: string implements HasColor, HasIcon, HasLabel
{
    case DRAFT = 'Draft';
    case SCHEDULED = 'Scheduled';
    case PUBLISHED = 'Published';
    case UNPUBLISHED = 'Unpublished';

    public function getLabel(): ?string
    {
        return ucfirst(strtolower($this->name));
        //        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-o-pencil-square',
            self::SCHEDULED => 'heroicon-o-clock',
            self::PUBLISHED => 'heroicon-o-check-circle',
            self::UNPUBLISHED => 'heroicon-o-eye-slash',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::SCHEDULED => 'success',
            self::PUBLISHED => 'success',
            self::UNPUBLISHED => 'danger',
        };
    }
}
