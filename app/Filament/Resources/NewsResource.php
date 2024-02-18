<?php

namespace App\Filament\Resources;

use App\Enums\NewsStatus;
use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RalphJSmit\Filament\MediaLibrary\Forms\Components\MediaPicker;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $slug = 'news';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'News Articles';

    protected static ?string $navigationGroup = 'News';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $article = $form->getRecord();

        return $form->schema([

            Tabs::make('Tabs')
                ->columnSpanFull()
                ->tabs([

                    Tab::make('General Info')
                        ->icon('heroicon-o-queue-list')
                        ->columns(2)
                        ->schema([

                            TextInput::make('title')
                                ->columnSpanFull()
                                ->maxLength(255)
                                ->reactive()
                                ->afterStateUpdated(function (Set $set, $state, $context) {
                                    if ($context === 'edit') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                })
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

                            TextInput::make('slug')
                                ->columnSpanFull()
                                ->label('Internal URL')
                                ->prefix('/news/')
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

                            Select::make('status')
                                ->native(false)
                                ->reactive()
                                ->options(NewsStatus::class)
                                ->default(NewsStatus::DRAFT->getLabel())
                                ->required(),

                            DatePicker::make('published_at')
                                ->disabled(function (Get $get) {
                                    $status = $get('status');
                                    //ray($status);
                                })
                                ->label('Publish(ed) on')
                                ->minDate(function (string $operation) {
                                    //                                    ray($operation);
                                    if ($operation === 'create') {
                                        return now();
                                    } else {
                                        return now()->subYears(100);
                                    }
                                })
                                ->format('d/m/Y')
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->weekStartsOnMonday()
                                ->closeOnDateSelection()
                                ->requiredUnless('status', NewsStatus::DRAFT->getLabel())
                                ->afterOrEqual(function (string $operation) {
                                    //ray($operation);
                                    if ($operation === 'create') {
                                        return 'today';
                                    } else {
                                        return '100 years ago';
                                    }
                                })
                                ->validationMessages([
                                    'requiredUnless' => 'The publish date can only be empty for a draft case News',
                                    //'minDate' => 'The publish date must be in the future',
                                ]),

                            Radio::make('version')
                                ->label('Article version (use 2024 for new articles)')
                                ->default('2024')
                                ->options([
                                    '2024' => '2024 site',
                                    '2017' => 'Old GC site',
                                ])
                                ->inline()
                                ->inlineLabel(false),

                            Fieldset::make()

                                ->columnSpanFull()
                                ->schema([

                                    CheckboxList::make('categories')
                                        ->columnSpanFull()
                                        ->label('Categories')
                                        ->relationship(titleAttribute: 'name')
                                        ->columns(4)
                                        ->required()
                                        ->validationMessages([
                                            'max' => 'You can only select 3 categories maximum',
                                        ]),

                                ]),
                        ]),

                    Tab::make('Main Content')
                        ->icon('heroicon-o-bars-3-center-left')
                        ->schema([

                            TextInput::make('summary')
                                ->required(),

                            RichEditor::make('content_2017')
                                ->hidden(fn (Get $get) => $get('version') != '2017'),

                            Builder::make('content')
                                ->blocks([

                                    Builder\Block::make('heading')
                                        ->schema([
                                            TextInput::make('text')
                                                ->label('Heading')
                                                ->required(),
                                            Select::make('level')
                                                ->label('Level')
                                                ->options([
                                                    'h3' => 'Heading 3',
                                                    'h4' => 'Heading 4',
                                                    'h5' => 'Heading 5',
                                                    'h6' => 'Heading 6',
                                                ])
                                                ->required(),
                                        ])
                                        ->columns(2)
                                        ->icon('heroicon-o-queue-list'),

                                    Builder\Block::make('quote')
                                        ->schema([
                                            Textarea::make('text')
                                                ->label('Quote text')
                                                ->required(),
                                            TextInput::make('name')
                                                ->label('Name of person quoting')
                                                ->required(),
                                        ])
                                        ->icon('heroicon-o-chat-bubble-left-ellipsis'),

                                    Builder\Block::make('paragraph')
                                        ->schema([
                                            Textarea::make('text')
                                                ->label('Quote text')
                                                ->required(),
                                        ])
                                        ->icon('heroicon-o-bars-3-bottom-left'),

                                    Builder\Block::make('paragraph_with_image')
                                        ->schema([
                                            Textarea::make('text')
                                                ->label('Quote text')
                                                ->required(),
                                            Radio::make('side')
                                                ->options([
                                                    'left' => 'Left of text',
                                                    'right' => 'Right of text',
                                                ])
                                                ->inline()
                                                ->inlineLabel(false)
                                                ->required(),
                                        ])
                                        ->icon('heroicon-o-identification'),

                                    Builder\Block::make('link')
                                        ->schema([
                                            TextInput::make('text')
                                                ->label('Link text to appear as link')
                                                ->maxLength('191')
                                                ->required(),
                                            TextInput::make('link')
                                                ->label('Link URL')
                                                ->maxLength('191')
                                                ->url(),
                                            TextInput::make('description')
                                                ->label('Link description (for screen readers)')
                                                ->maxLength('100')
                                                ->required(),
                                        ])
                                        ->icon('heroicon-o-link'),

                                    Builder\Block::make('image')
                                        ->schema([
                                            MediaPicker::make('featured_image_id')
                                                ->defaultFolder(MediaLibraryFolder::find(99)),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                            TextInput::make('link')
                                                ->label('Alt text')
                                                ->url(),
                                        ])
                                        ->icon('heroicon-o-photo'),

                                ])
                                ->blockPickerColumns(3)
                                ->blockPickerWidth('2xl')
                                ->blockNumbers(false)
                                ->addActionLabel('Add a new block')
                                ->reorderableWithButtons()
                                ->hidden(fn (Get $get) => $get('version') != '2024'),

                        ]),

                    Tab::make('Images')
                        ->icon('heroicon-o-photo')
                        ->schema([

                            MediaPicker::make('image_hero')
                                ->label('Hero image for Article details page')
                                ->columnSpanFull()
                                ->folder(MediaLibraryFolder::find(3)),

                            //                            SpatieMediaLibraryFileUpload::make('news_hero')
                            //                                ->label('Hero image for Article details page')
                            //                                ->columnSpanFull()
                            //                                ->hint(str('1536px wide x (max) 650px tall')->inlineMarkdown()->toHtmlString())
                            //                                ->hintIcon('heroicon-o-scissors')
                            //                                ->hintColor('warning')
                            //                                ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                            //                                ->collection('news_hero')
                            //                                ->disk('s3_filament_image_uploads')
                            //                                ->responsiveImages()
                            //                                ->rules(['mimes:jpg', 'dimensions:width=1536,min_height=500,max_height=650'])
                            //                                ->required(),

                            MediaPicker::make('image_index')
                                ->label('Image for news homeapge and related articles')
                                ->columnSpanFull()
                                ->folder(MediaLibraryFolder::find(2)),

                            //                            SpatieMediaLibraryFileUpload::make('news_index')
                            //                                ->label('Image for News list (and related news)')
                            //                                ->columnSpanFull()
                            //                                ->hint(str('459px wide x 459px tall')->inlineMarkdown()->toHtmlString())
                            //                                ->hintIcon('heroicon-o-scissors')
                            //                                ->hintColor('warning')
                            //                                ->helperText(str('*Required*')->inlineMarkdown()->toHtmlString())
                            //                                ->collection('news_index')
                            //                                ->disk('s3_filament_image_uploads')
                            //                                ->responsiveImages()
                            //                                ->rules(['mimes:jpg', 'dimensions:width=459,height=459'])
                            //                                ->required(),

                        ]),

                    Tab::make('Related articles')
                        ->icon('heroicon-o-share')
                        ->schema([

                            Select::make('related_1')
                                ->label('Related 1')
                                ->options(function ($context) use ($article) {
                                    return self::getRelatedOptions($context, $article);
                                })
                                ->live()
                                ->searchable()
                                ->selectablePlaceholder(false)
                                ->rule(
                                    fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                        if ($get('related_2') == $value) {
                                            $fail('This related study must be different to the other related studies');
                                        }
                                    },
                                )
                                ->required(),

                            Select::make('related_2')
                                ->label('Related 2')
                                ->options(function ($context) use ($article) {
                                    return self::getRelatedOptions($context, $article);
                                })
                                ->live()
                                ->searchable()
                                ->selectablePlaceholder(false)
                                ->rule(
                                    fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                        if ($get('related_1') == $value) {
                                            $fail('This related study must be different to the other related studies');
                                        }
                                    },
                                )
                                ->required(),
                        ]),

                ]),

        ]);
    }

    public static function getRelatedOptions($context, $study): Collection
    {
        if ($context === 'edit') {
            $related_articles = News::where('status', NewsStatus::PUBLISHED)
                ->whereNotIn('id', [$study->id])
                ->get()->pluck('title', 'id');
        } else {
            $related_articles = News::where('status', NewsStatus::PUBLISHED)
                ->get()->pluck('title', 'id');
        }

        return $related_articles;
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->searchable()
                ->sortable(),

            TextColumn::make('summary'),

            TextColumn::make('slug')
                ->searchable()
                ->sortable(),

            TextColumn::make('meta_title'),

            TextColumn::make('meta_desc'),

            TextColumn::make('related_1'),

            TextColumn::make('related_2'),

            TextColumn::make('status'),

            TextColumn::make('published_at')
                ->label('Published Date')
                ->date(),

            TextColumn::make('version'),

            TextColumn::make('user_id'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug'];
    }
}
