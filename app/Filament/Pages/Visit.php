<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class Visit extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Visits';

    protected static string $view = 'filament.pages.visit';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Visit::query())
            ->columns([
                TextColumn::make('ip')->searchable(),
                TextColumn::make('url')->searchable(),
                TextColumn::make('params')->searchable(),
                TextColumn::make('created_at')->searchable(),
            ])->filters([
                SelectFilter::make('url')
                ->options([
                    'home' => 'Home',
                    'product' => 'Product',
                    'product_detail' => 'Product Detail',
                    'contact' => 'Contact',
                ])
            ])
            ->actions([
                
            ])
            ->bulkActions([
                ExportBulkAction::make()
            ]);;
    }
}
