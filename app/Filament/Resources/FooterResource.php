<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterResource\Pages;
use App\Filament\Resources\FooterResource\RelationManagers;
use App\Models\Footer;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Home Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Address')->schema([
                    RichEditor::make('address')->toolbarButtons([
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
                    ]),
                ])->columns(2),
                Section::make('Follow Us')->schema([
                    TextInput::make('instagram_username'),
                    TextInput::make('instagram_url'),
                    TextInput::make('youtube_url'),
                    TextInput::make('facebook_url'),
                ])->columns(2),
                Section::make('Online Services')->schema([
                    TextInput::make('shopee_url'),
                    TextInput::make('tokopedia_url'),
                ])->columns(2),
                Section::make('Contact')->schema([
                    TextInput::make('email'),
                ])->columns(2),
                Section::make('Background Page')->schema([
                    FileUpload::make('background_product')->label('Background page product (16:9)')->directory('background_product')->image()->imageEditor()->imageEditorAspectRatios([
                        '16:9',
                    ])->helperText('Image akan di tampilkan di page produk dengan ukuran height 500px'),
                    FileUpload::make('background_contact')->label('Background page contact (16:9)')->directory('background_contact')->image()->imageEditor()->imageEditorAspectRatios([
                        '16:9',
                    ])->helperText('Image akan di tampilkan di page produk dengan ukuran height 500px'),
                    FileUpload::make('background_download_center')->label('Background page download center (16:9)')->directory('background_download_center')->image()->imageEditor()->imageEditorAspectRatios([
                        '16:9',
                    ])->helperText('Image akan di tampilkan di page produk dengan ukuran height 500px'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('address')->html(),
                TextColumn::make('instagram_username'),
                TextColumn::make('instagram_url'),
                TextColumn::make('youtube_url'),
                TextColumn::make('facebook_url'),
                TextColumn::make('shopee_url'),
                TextColumn::make('tokopedia_url'),
                TextColumn::make('email'),
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
