<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageHeroResource\Pages;
use App\Models\HomepageHero;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomepageHeroResource extends Resource
{
    protected static ?string $model = HomepageHero::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('Central Block')
                            ->icon('heroicon-o-viewfinder-circle')
                            ->columns(2)
                            ->schema([

                                TextInput::make('central_block_text')
                                    ->columnSpanFull()
                                    ->label('The text for the central block')
                                    ->maxLength(100)
                                    ->required(),

                                TextInput::make('central_block_link_text')
                                    ->columnSpanFull()
                                    ->label('The text for the link in the central block')
                                    ->maxLength(15)
                                    ->required(),

                                TextInput::make('central_block_link_url')
                                    ->columnSpanFull()
                                    ->label('The URL for the link in the central block')
                                    ->maxLength(255)
                                    ->required(),
                            ]),

                        Tab::make('Left Tall Block')
                            ->icon('heroicon-o-arrow-left')
                            ->schema([

                            ]),

                        Tab::make('Top Middle Block')
                            ->icon('heroicon-o-arrow-up')
                            ->schema([

                            ]),

                        Tab::make('Top Right Block')
                            ->icon('heroicon-o-arrow-up-right')
                            ->schema([

                            ]),

                        Tab::make('Bottom Right Block')
                            ->icon('heroicon-o-arrow-down-right')
                            ->schema([

                            ]),

                        Tab::make('Bottom Middle Block')
                            ->icon('heroicon-o-arrow-down')
                            ->schema([

                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListHomepageHeroes::route('/'),
            'create' => Pages\CreateHomepageHero::route('/create'),
            'edit' => Pages\EditHomepageHero::route('/{record}/edit'),
        ];
    }
}
