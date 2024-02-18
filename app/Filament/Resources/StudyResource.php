<?php

namespace App\Filament\Resources;

use App\Enums\StudyStatus;
use App\Filament\Resources\StudyResource\Pages;
use App\Models\Study;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class StudyResource extends Resource
{
    protected static ?string $model = Study::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Case Studies';

    protected static ?string $navigationGroup = 'Studies';

    protected static ?int $navigationSort = 1;

    //    public ?Model $record = null;

    public static function form(Form $form): Form
    {
        $study = $form->getRecord();
        $hover_text_length = 120;
        //ray($study);

        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('General Info')
                            ->icon('heroicon-o-list-bullet')
                            ->columns(2)
                            ->schema([

                                TextInput::make('title')
                                    ->maxLength(255)
                                    ->reactive()
                                    ->afterStateUpdated(function (Set $set, $state, $context) {
                                        if ($context === 'edit') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    })
                                    ->required(),

                                TextInput::make('related_title')
                                    ->label('A shorter title used in the Related Case Studies blocks')
                                    ->maxLength(255)
                                    ->required(),

                                TextInput::make('html_title')
                                    ->columnSpanFull()
                                    ->label('The SEO title')
                                    ->prefix('Rawlings | ')
                                    ->maxLength(255)
                                    ->required(),

                                TextInput::make('meta_desc')
                                    ->columnSpanFull()
                                    ->label('The SEO meta description')
                                    ->maxLength(1000)
                                    ->required(),

                                Select::make('status')
                                    ->native(false)
                                    ->reactive()
                                    ->options(StudyStatus::class)
                                    ->default(StudyStatus::DRAFT->getLabel())
                                    ->required(),

                                DatePicker::make('published_at')
                                    ->disabled(function (Get $get) {
                                        $status = $get('status');
                                        //ray($status);
                                    })
                                    ->label('Publish(ed) on')
                                    ->format('d/m/Y')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->minDate(function (string $operation) {
                                        //                                    ray($operation);
                                        if ($operation === 'create') {
                                            return now();
                                        } else {
                                            return now()->subYears(100);
                                        }
                                    })
                                    ->weekStartsOnMonday()
                                    ->closeOnDateSelection()
                                    ->requiredUnless('status', StudyStatus::DRAFT->getLabel())
                                    ->afterOrEqual(function (string $operation) {
                                        //ray($operation);
                                        if ($operation === 'create') {
                                            return 'today';
                                        } else {
                                            return '100 years ago';
                                        }
                                    })
                                    ->validationMessages([
                                        'requiredUnless' => 'The publish date can only be empty for a draft case Study',
                                        //'minDate' => 'The publish date must be in the future',
                                    ]),

                                TextInput::make('slug')
                                    ->label('Internal URL')
                                    ->prefix('/case-studies/')
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function (?string $state, ?string $old) {
                                        if ($state !== $old) {
                                            Notification::make()
                                                ->title('Are you sure you want to edit the slug?')
                                                ->body('It will affect SEO for this study if the slug is updated so only do this if the study is in draft')
                                                ->danger()
                                                ->color('danger')
                                                ->persistent()
                                                ->send();
                                        }
                                    })
                                    ->hintAction(
                                        Action::make('undoSlugUpdate')
                                            ->icon('heroicon-o-arrow-path')
                                            ->color('primary')
                                            ->requiresConfirmation()
                                            ->action(function (Get $get, Set $set, $state) {
                                                $set('slug', $get('original_slug'));
                                            })
                                    )
                                    ->required()
                                    ->maxLength(255)
                                    ->alphaDash()
                                    ->unique(ignoreRecord: true),

                                Hidden::make('original_slug')
                                    ->afterStateHydrated(function (Get $get, Set $set, Hidden $component, $state) {
                                        //                                        ray($get('slug'));
                                        $component->state($get('slug'));
                                    }),

                                Fieldset::make()

                                    ->columnSpanFull()
                                    ->schema([

                                        CheckboxList::make('categories')
                                            ->columnSpanFull()
                                            ->label('Categories')
                                            ->relationship(titleAttribute: 'name')
                                            ->columns(4)
                                            ->rules(['max:3'])
                                            ->required()
                                            ->validationMessages([
                                                'max' => 'You can only select 3 categories maximum',
                                            ]),

                                    ]),
                            ]),

                        Tab::make('Main Content')
                            ->icon('heroicon-o-bars-3-center-left')
                            ->schema([

                                RichEditor::make('brief')
                                    ->disableAllToolbarButtons()
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->label('The Brief')
//                                    ->rows(10)
//                                    ->autosize()
                                    ->required(),

                                RichEditor::make('approach')
                                    ->disableAllToolbarButtons()
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->label('The Approach')
//                                    ->rows(10)
//                                    ->autosize()
                                    ->required(),

                                RichEditor::make('result')
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->disableAllToolbarButtons()
                                    ->label('The Result')
//                                    ->rows(10)
//                                    ->autosize()
                                    ->required(),

                                RichEditor::make('quote')
                                    ->disableAllToolbarButtons()
                                    ->extraAttributes(['style' => 'height: 100px;'])
                                    ->label('Client quote')
//                                    ->rows(8)
//                                    ->autosize()
                                    ->required(),

                                TextInput::make('client')
                                    ->label('Client name and role')
                                    ->maxLength(255)
                                    ->required(),

                                TextInput::make('url')
                                    ->label('Client\'s website')
                                    ->maxLength(255)
                                    ->url(),

                            ]),

                        Tab::make('Other Content')
                            ->icon('heroicon-o-document-text')
                            ->schema([

                                Textarea::make('homepage_text')
                                    ->label('Hover text to go with Homepage featured image')
                                    ->rows(10)
                                    ->hint(function ($state) use ($hover_text_length) {
                                        $length = 120;
                                        $remaining = $hover_text_length - strlen($state);
                                        if ($remaining < 0) {
                                            $remaining = 0;

                                        }

                                        return $remaining.' characters remaining';
                                    })
                                    ->hintColor(function ($state) use ($hover_text_length) {
                                        $length = 120;
                                        $remaining = $hover_text_length - strlen($state);
                                        if ($remaining > 0) {
                                            return 'primary';
                                        }

                                        return 'danger';
                                    })
                                    ->live()
                                    ->rule('max:'.$hover_text_length)
                                    ->required(),

                                Textarea::make('study_list_text')
                                    ->label('Hover text to go with Study list image')
                                    ->rows(10)
                                    ->hint(function ($state) use ($hover_text_length) {
                                        $length = 120;
                                        $remaining = $hover_text_length - strlen($state);
                                        if ($remaining < 0) {
                                            $remaining = 0;

                                        }

                                        return $remaining.' characters remaining';
                                    })
                                    ->hintColor(function ($state) use ($hover_text_length) {
                                        $length = 120;
                                        $remaining = $hover_text_length - strlen($state);
                                        if ($remaining > 0) {
                                            return 'primary';
                                        }

                                        return 'danger';
                                    })
                                    ->live()
                                    ->rule('max:'.$hover_text_length)
                                    ->required(),

                            ]),

                        Tab::make('Images')
                            ->icon('heroicon-o-photo')
                            ->schema([

                                Fieldset::make('HERO IMAGE')
                                    ->columnSpanFull()
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('studies_show_hero')
                                            ->label('Hero image for Study details page')
                                            ->columnSpanFull()
                                            ->hint(str('1536px wide x (max) 850px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_hero')
//                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=1536,max_height=850'])
                                            ->required(),

                                    ]),

                                Fieldset::make('HALF WIDTH IMAGES')
                                    ->columns(2)
//                                    ->columnSpanFull()
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('studies_show_brief')
                                            ->id('studies_show_half_1')
//                                            ->columnSpanFull()
                                            ->label('1st half width image for Study details page')
                                            ->hint(str('744px wide x 744px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Optional but required if using the other half width image*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_brief')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=744,height=744'])
                                            ->requiredWith('studies_show_approach'),

                                        SpatieMediaLibraryFileUpload::make('studies_show_approach')
                                            ->id('studies_show_half_2')
//                                            ->columnSpanFull()
                                            ->label('2nd half width image for Study details page')
                                            ->hint(str('744px wide x 744px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Optional but required if using the other half width image*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_approach')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=744,height=744'])
                                            ->requiredWith('studies_show_brief'),

                                    ]),

                                Fieldset::make('FULL WIDTH IMAGES')
                                    ->columnSpanFull()
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->schema([

                                        SpatieMediaLibraryFileUpload::make('studies_show_full_top')
                                            ->columnSpanFull()
                                            ->label('Middle full width image for Study details page')
                                            ->hint(str('1536px wide x (max) 750px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Optional but prefered*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_full_top')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=1536,max_height=750']),

                                        SpatieMediaLibraryFileUpload::make('studies_show_full_bottom')
                                            ->columnSpanFull()
                                            ->label('End full width image for Study details page')
                                            ->hint(str('1536px wide x (max) 750px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Optional*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_full_bottom')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=1536,max_height=750']),

                                    ]),

                                Fieldset::make('OTHER IMAGES')
                                    ->columns(2)
                                    ->extraAttributes(['style' => 'margin: 0 0 30px 0;'])
                                    ->schema([

                                        SpatieMediaLibraryFileUpload::make('studies_homepage')
//                                            ->columnSpanFull()
                                            ->label('Background image for homepage block')
                                            ->hint(str('384px wide x 384px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_homepage')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->required()
                                            ->rules(['mimes:jpg', 'dimensions:width=384,height=384']),

                                        SpatieMediaLibraryFileUpload::make('studies_our_work')
//                                            ->columnSpanFull()
                                            ->label('Logo for Our Work list')
                                            ->hint(str('508px wide x 333px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_our_work')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->required()
                                            ->rules(['mimes:jpg', 'dimensions:width=508,height=333']),

                                        SpatieMediaLibraryFileUpload::make('studies_show_related')
//                                            ->columnSpanFull()
                                            ->label('Related studies image for Study details page')
                                            ->hint(str('448px wide x 285px tall')->inlineMarkdown()->toHtmlString())
                                            ->hintIcon('heroicon-o-scissors')
                                            ->hintColor('warning')
                                            ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                                            ->collection('studies_show_related')
                                            ->disk('s3_filament_image_uploads')
                                            ->responsiveImages()
                                            ->rules(['mimes:jpg', 'dimensions:width=448,height=285'])
                                            ->required(),

                                    ]),
                            ]),

                        Tab::make('Related Studies')
                            ->icon('heroicon-o-share')
                            ->schema([

                                Select::make('related_1')
                                    ->label('Related 1')
                                    ->options(function ($context) use ($study) {
                                        return self::getRelatedOptions($context, $study);
                                    })
                                    ->live()
                                    ->searchable()
                                    ->selectablePlaceholder(false)
                                    ->rule(
                                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                            if ($get('related_2') == $value || $get('related_3') == $value) {
                                                $fail('This related study must be different to the other related studies');
                                            }
                                        },
                                    )
                                    ->required(),

                                Select::make('related_2')
                                    ->label('Related 2')
                                    ->options(function ($context) use ($study) {
                                        return self::getRelatedOptions($context, $study);
                                    })
                                    ->live()
                                    ->searchable()
                                    ->selectablePlaceholder(false)
                                    ->rules([
                                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                            if ($get('related_1') == $value || $get('related_3') == $value) {
                                                $fail('This related study must be different to the other related studies');
                                            }
                                        },
                                    ])
                                    ->required(),

                                Select::make('related_3')
                                    ->label('Related 3')
                                    ->options(function ($context) use ($study) {
                                        return self::getRelatedOptions($context, $study);
                                    })
                                    ->live()
                                    ->searchable()
                                    ->selectablePlaceholder(false)
                                    ->rules([
                                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                            if ($get('related_1') == $value || $get('related_2') == $value) {
                                                $fail('This related study must be different to the other related studies');
                                            }
                                        },
                                    ])
                                    ->required(),

                            ]),

                    ]),
            ]);
    }

    public static function getRelatedOptions($context, $study): Collection
    {
        if ($context === 'edit') {
            $related_studies = Study::where('status', StudyStatus::PUBLISHED)
                ->whereNotIn('id', [$study->id])
                ->get()->pluck('title', 'id');
        } else {
            $related_studies = Study::where('status', StudyStatus::PUBLISHED)
                ->get()->pluck('title', 'id');
        }

        return $related_studies;

        //                                    ->options(function ($context) use ($study) {
        //                                        if ($context === 'edit') {
        //                                            return
        //                                                Study::where('status', StudyStatus::PUBLISHED)
        //                                                    ->whereNotIn('id', [$study->id])
        //                                                    ->get()->pluck('title', 'id');
        //                                        }
        //
        //                                        return Study::where('status', StudyStatus::PUBLISHED)
        //                                            ->get()->pluck('title', 'id');
        //                                    })
    }
    //
    //    public static function validateRelatedOptions(Get $get, $related_study)
    //    {
    //        $related = [1, 2, 3];
    //        unset($related[$related_study]);
    //        $related_studies = array_values($related);
    //        ray($related_studies);
    //
    //        return function ($related_studies) {
    //            return function (string $attribute, $value, Closure $fail) use ($get, $related_studies) {
    //                ray($related_studies);
    //                if ($get('related_'.$related_studies[0]) == $value || $get('related_'.$related_studies[1]) == $value) {
    //                    $fail('This related study must be different to the other related studies');
    //                }
    //            };
    //        };
    //    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->columns([
                TextColumn::make('title'),
                IconColumn::make('status'),
                //                    ->icon(fn (string $state): string => match ($state) {
                //                        'pending' => 'heroicon-o-clock',
                //                        'published' => 'heroicon-o-check-circle',
                //                        'inactive' => 'heroicon-o-check-circle',
                //                    })
                //                    ->color(fn (string $state): string => match ($state) {
                //                        'pending' => 'warning',
                //                        'published' => 'success',
                //                        'inactive' => 'danger',
                //                        default => 'gray',
                //                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudies::route('/'),
            'create' => Pages\CreateStudy::route('/create'),
            'edit' => Pages\EditStudy::route('/{record}/edit'),
        ];
    }
}
