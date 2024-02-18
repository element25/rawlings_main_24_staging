<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyCategoryResource\Pages;
use App\Models\StudyCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudyCategoryResource extends Resource
{
    protected static ?string $model = StudyCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'study-categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?string $navigationGroup = 'Studies';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),

            TextInput::make('short_name')
                ->required(),

            //            TextInput::make('icon')
            //                ->label('Internal URL')
            //                ->prefix('/herocions-o-')
            //                ->required()
            //                ->maxLength(255)
            //                ->alphaDash(),

            // USE THIS WHEN V3 COMPATIBLE
            // https://github.com/rockero-cz/filament-simple-color-picker
            Select::make('colour')
                ->options([
                    'text-rawl-purple' => 'Purple',
                    'text-teal-700' => 'Teal',
                    'text-rawl-yellow' => 'Rawlings yellow',
                    'text-rawl-blue' => 'Rawlings blue',
                    'text-yellow-400' => 'Yellow',
                    'text-amber-700' => 'Amber',
                    'text-rawl-green' => 'Rawlings green',
                    'text-rose-700' => 'Red',
                    'text-indigo-700' => 'Indigo',
                ])
                ->native(false)
                ->allowHtml()
                ->required(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->columns([
                TextColumn::make('name'),

                SelectColumn::make('colour')
                    ->options([
                        'text-rawl-purple' => 'Purple',
                        'text-teal-700' => 'Teal',
                        'text-rawl-yellow' => 'Rawlings yellow',
                        'text-rawl-blue' => 'Rawlings blue',
                        'text-yellow-400' => 'Yellow',
                        'text-amber-700' => 'Amber',
                        'text-rawl-green' => 'Rawlings green',
                        'text-rose-700' => 'Red',
                        'text-indigo-700' => 'Indigo',
                    ])
                    ->rules(['required']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudyCategories::route('/'),
            'create' => Pages\CreateStudyCategory::route('/create'),
            'edit' => Pages\EditStudyCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
