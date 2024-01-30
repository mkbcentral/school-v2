<?php

namespace App\Livewire\Helpers\Movement;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\BankDeposit;

class DepositBankHelper
{
    /**
     * get Amount deposit bank USD
     * @return void
     */
    public static  function getAmountDepositBank(string $currency): int|float
    {
        return BankDeposit::join('currencies', 'currencies.id', 'bank_deposits.currency_id')
            ->select('bank_deposits.*')
            ->where('currencies.currency', $currency)
            ->where('bank_deposits.scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->sum('bank_deposits.amount');
    }
}
