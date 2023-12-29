<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Info')->collapsible()->schema([
                    Select::make('type_id')->relationship('type', 'name')
                        ->required()->label("Type"),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('brand')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('height')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('width')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('length')
                        ->maxLength(50),
                    FileUpload::make('images')->label('Main Photo (16:9)')->required()->directory('product_images')->image()->columnSpan(2),
                    FileUpload::make('wallpaper')->label('Wallpaper (16:9)')->required()->directory('wallpapers')->image()->columnSpan(2),
                    RichEditor::make('description')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('descriptions')->columnSpan(4),
                ])->columns(4),

                Section::make('Detail Specification')->collapsible()->schema([
                    FileUpload::make('lighting_image')->label('Lighting Photo (4:3)')->required()->directory('lighting_images')->image()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                    RichEditor::make('lighting')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('lightings'),
                    FileUpload::make('coaches_image')->label('Coaches Photo (4:3)')->required()->directory('coaches_images')->image()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                    RichEditor::make('couches')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('couchess'),
                    FileUpload::make('interior_image')->label('Interior Photo (4:3)')->required()->directory('interior_images')->image()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                    RichEditor::make('interior')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('interiors'),
                    FileUpload::make('exterior_image')->label('Exterior Photo (4:3)')->required()->directory('exterior_images')->image()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                    RichEditor::make('exterior')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('exteriors'),
                    FileUpload::make('driver_station_image')->label('Driver Station Photo (4:3)')->required()->directory('driver_station_images')->image()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                    RichEditor::make('driver_station')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])->fileAttachmentsDirectory('driver_stations'),
                ])->columns(2),
                Section::make('Photos and Video')->collapsible()->schema([
                    Forms\Components\TextInput::make('video')
                        ->label('Video (Url Youtube)')
                        ->maxLength(255),
                    FileUpload::make('gallery')->label('File Photo (4:3) (Multiple)')->directory('galleries')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ]),
                ])->columns(2),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('height')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('width')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('length')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
