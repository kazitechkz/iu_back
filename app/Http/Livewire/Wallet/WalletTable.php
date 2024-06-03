<?php

namespace App\Http\Livewire\Wallet;

use App\Exports\WalletExport;
use App\Models\Subject;
use App\Models\User;
use Bavix\Wallet\Models\Wallet;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Zorb\Promocodes\Models\Promocode;

class WalletTable extends DataTableComponent
{
    protected $model = Wallet::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setDefaultSort('balance', 'desc');
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('wallet.edit', $row);
            });
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Имя")
                ->label(fn($v) => $this->getUserName($v['id']))
                ->sortable()->searchable(),
            Column::make("Balance")
                ->label(fn($v) => $this->getUserBalance($v['id']))
                ->sortable()->searchable(),
            Column::make("Email")
                ->label(fn($v) => $this->getUserEmail($v['id']))
                ->searchable(),
        ];
    }
    public function getUserBalance($walletID) {
        $wallet = Wallet::with('holder')->find($walletID);
        return $wallet->holder ? $wallet->holder->balanceInt : '';
    }
    public function getUserEmail($walletID) {
        $wallet = Wallet::with('holder')->find($walletID);
        return $wallet->holder ? $wallet->holder->email : '';
    }
    public function getUserName($walletID) {
        $wallet = Wallet::with('holder')->find($walletID);
        return $wallet->holder ? $wallet->holder->name : '';
    }
    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }

}
