<?php

namespace App\Http\Controllers;

use App\Livewire\Helpers\Movement\DepositBankHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\AgentSalary;
use App\Models\BankDeposit;
use App\Models\MoneySaving;
use Illuminate\Support\Facades\App;

class OtherMovementController extends Controller
{
    //Print deposit bank by month
    public function printDepositBankByMonth($month)
    {
        $bankDeposits = BankDeposit::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at')->paginate(20);
        $total_cdf = DepositBankHelper::getAmountDepositBankByMonth('USD', $month);
        $total_usd = DepositBankHelper::getAmountDepositBankByMonth('CDF', $month);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.movements.print-deposit-bank',
            compact([
                'bankDeposits',
                'month', 'total_cdf', 'total_usd'
            ])
        )->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    //Print money saving
    public function printMoneySaving()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.movements.print-money-saving',
            [
                'moneySavings' => MoneySaving::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)->get()
            ]
        );
        return $pdf->stream();
    }

    //Print agent salary
    public function printAgentSalary()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.movements.print-agent-salary',
            [
                'agentSalaries' => AgentSalary::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)->get()
            ]
        )->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
