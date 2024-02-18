<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StudyCategory: string implements HasLabel // HasIcon,  //HasColor,
{
    case NPD = 'New product development';
    case BESPOKE_GLASS = 'Bespoke glass';
    case BESPOKE_LABELS = 'Bespoke labels';
    case LOGO_DESIGN = 'Logo designs';
    case LABEL_DESIGN = 'Label design';

    //['id' => 1, 'label' => 'New product development', 'colour' => 'text-rawl-purple'],
    //['id' => 2, 'label' => 'Bespoke glass', 'colour' => 'text-teal-700'],
    //['id' => 3, 'label' => 'Light-weigting', 'colour' => 'text-rawl-yellow'],
    //['id' => 4, 'label' => 'Screen printing', 'colour' => 'text-rawl-blue'],
    //['id' => 5, 'label' => 'Bespoke labels', 'colour' => 'text-yellow-400'],
    //['id' => 6, 'label' => 'Shrink sleeving', 'colour' => 'text-rawl-purple-dark'],
    //['id' => 7, 'label' => 'Brand creation', 'colour' => 'text-emerald-500'],
    //['id' => 8, 'label' => 'Logo design', 'colour' => 'text-amber-700'],
    //['id' => 9, 'label' => 'Label design', 'colour' => 'text-rawl-green'],
    //['id' => 10, 'label' => 'Bespoke caps', 'colour' => 'text-rose-700'],
    //['id' => 11, 'label' => 'Supply chain streamlining', 'colour' => 'text-indigo-700'],

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getStudyCategoryId(): array
    {
        return match ($this) {
            StudyCategory::NPD => 1,
            StudyCategory::BESPOKE_GLASS => 2,
            StudyCategory::BESPOKE_LABELS => 3,
            StudyCategory::LOGO_DESIGN => 4,
            StudyCategory::LABEL_DESIGN => 5,
        };
    }

    //    public function getIcon(): ?string
    //    {
    //        return match ($this) {
    //            self::DRAFT => 'heroicon-o-pencil-square',
    //            self::SCHEDULED => 'heroicon-o-clock',
    //            self::PUBLISHED => 'heroicon-o-check-circle',
    //            self::UNPUBLISHED => 'heroicon-o-eye-slash',
    //        };
    //    }

    //    public function getColor(): string|array|null
    //    {
    //        return match ($this) {
    //            self::DRAFT => 'gray',
    //            self::SCHEDULED => 'success',
    //            self::PUBLISHED => 'success',
    //            self::UNPUBLISHED => 'danger',
    //        };
    //    }
}
