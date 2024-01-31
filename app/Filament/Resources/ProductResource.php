<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
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
                        ->helperText('Digunakan untuk ke url detail produk. Harus huruf kecil dan tidak boleh ada spasi. Contoh: skylander-r22')
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
                    Toggle::make('show_in_home')->inline(false)->helperText('Jika ON maka produk akan tertampil di Home page'),
                    FileUpload::make('images')->label('Main Photo (1:1)')->directory('product/product_images')->image()->imageEditor()->imageEditorAspectRatios([
                        '1:1',
                    ])->helperText('Image akan di tampilkan di list produk dengan ukuran 250px x 250px')->required()->columnSpan(2),
                    FileUpload::make('home_photo')->label('Home Photo (16:9)')->directory('product/home_photos')->image()->imageEditor()->imageEditorAspectRatios([
                        '16:9',
                    ])->helperText('Image akan di tampilkan di halaman beranda dengan ukuran 1080px x 720px (Show in Home dalam keadaan aktif)')->required()->columnSpan(2),
                    FileUpload::make('wallpaper')->label('Wallpaper (16:9)')->directory('product/wallpapers')->image()->helperText('Image akan di tampilkan ketika ke product detail, Ukuran akan height akan diubah ke 500px')->required()->columnSpan(2),
                    FileUpload::make('catalog')->label('Catalog (PDF)')->acceptedFileTypes(['application/pdf'])->directory('product/catalogs')->columnSpan(2),
                    RichEditor::make('description')
                        ->toolbarButtons([
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
                    FileUpload::make('lighting_images')->label('Lighting Photo Max 3 file (4:3)')->directory('product/lighting_images')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])->required(),
                    RichEditor::make('lighting')
                        ->toolbarButtons([                            
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
                    FileUpload::make('couches_images')->label('Coaches Photo Max 3 file (4:3)')->directory('product/coaches_images')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])->required(),
                    RichEditor::make('couches')
                        ->toolbarButtons([
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
                    FileUpload::make('interior_images')->label('Interior Photo Max 3 file (4:3)')->directory('product/interior_images')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])->required(),
                    RichEditor::make('interior')
                        ->toolbarButtons([
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
                    FileUpload::make('exterior_images')->label('Exterior Photo Max 3 file (4:3)')->directory('product/exterior_images')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])->required(),
                    RichEditor::make('exterior')
                        ->toolbarButtons([
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
                    FileUpload::make('driver_station_images')->label('Driver Station Photo Max 3 file (4:3)')->directory('product/driver_station_images')->image()->multiple()->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])->required(),
                    RichEditor::make('driver_station')
                        ->toolbarButtons([
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
                Section::make('Gallery and Video')->collapsible()->schema([
                    FileUpload::make('gallery')->label('File Photo (Mininal 4 image)')->directory('product/product_detail_galleries')->image()->multiple()->imageEditor()->required(),
                    Forms\Components\TextInput::make('video')
                        ->label('Video (Url Youtube)')
                        ->helperText('Tidak perlu https://www.youtube.com/watch?v=. Hanya key nya saja. Contoh: l7UHBTUewKw?si=uqApPUA_LCV1-qhJ')
                        ->maxLength(255),
                ])->columns(2),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.name')
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
