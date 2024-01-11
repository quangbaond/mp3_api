<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithDrawResource\Pages;
use App\Filament\Resources\WithDrawResource\RelationManagers;
use App\Models\WithDraw;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WithDrawResource extends Resource
{
    protected static ?string $model = WithDraw::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Rút tiền';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Thông tin cơ bản")
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Tên người dùng')
                        ->relationship('user', 'user_name')
                        ->required(),
                    Forms\Components\TextInput::make('amount')
                        ->label('Số tiền')
                        ->required()
                        ->numeric()
                        ->placeholder('Nhập Số tiền'),
                    Forms\Components\Select::make('status')
                        ->label('Trạng thái')
                        ->options([
                            'Đang chờ xét duyệt' => 'Chờ duyệt',
                            'Đã duyệt' => 'Đã duyệt',
                            'Từ chối' => 'Từ chối',
                        ])
                        ->placeholder('Chọn trạng thái'),
                    Forms\Components\TextInput::make('bank_branch')
                        ->label('Tên ngân hàng')
                        ->required()
                        ->maxValue(255)
                        ->placeholder('Nhập tên ngân hàng'),
                    Forms\Components\TextInput::make('bank_account_number')
                        ->label('Số tài khoản')
                        ->required()
                        ->maxValue(255)
                        ->placeholder('Nhập số tài khoản'),
                    Forms\Components\TextInput::make('bank_account_name')
                        ->label('Tên tài khoản')
                        ->required()
                        ->maxValue(255)
                        ->placeholder('Nhập tên tài khoản'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.user_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (WithDraw $record) => match ($record->status) {
                        'Đang chờ xét duyệt' => 'gray',
                        'Đã duyệt' => 'green',
                        'Từ chối' => 'red',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_branch')
                    ->label('Tên ngân hàng')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_account_number')
                    ->label('Số tài khoản')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_account_name')
                    ->label('Tên tài khoản')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
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
            'index' => Pages\ListWithDraws::route('/'),
            'create' => Pages\CreateWithDraw::route('/create'),
            'edit' => Pages\EditWithDraw::route('/{record}/edit'),
        ];
    }
}
