<?php

use App\Http\Controllers\Application\Pages\ApplicationLinkController;
use App\Livewire\Application\Dashboard\MainDashboard;
use App\Livewire\Application\Inscription\NewInscription;
use App\Livewire\Application\Inscription\NewReinscription;
use App\Livewire\Application\Payment\ValideInscriptionPayment;
use Illuminate\Support\Facades\Route;
use App\Livewire\Application\Payment\OtherCostPayment;
use App\Livewire\Application\Settings\AppLinkSettings;
use App\Livewire\Application\Settings\AppSettings;
use App\Livewire\Application\Rapport\PaymentRapport;
use App\Http\Controllers\Application\Printings\RapportInscriptionPaymentPrintingController;
use App\Livewire\Application\Rapport\Inscription\RapportInscriptionByClasse;
use App\Http\Controllers\Application\Pages\CreateSchoolController;
use App\Http\Controllers\Application\Printings\ListInscriptionController;
use App\Http\Controllers\Application\Printings\PrintingDepenseAndEmpruntController;
use App\Livewire\Application\Payment\MainControlPayment;
use App\Livewire\Application\Rapport\Payment\RapportAllReceiptBySection;
use App\Http\Controllers\Application\Printings\PrintingReceiptController;
use App\Livewire\Application\Depense\ListEmprunt;
use App\Livewire\Application\Depense\MyDepense;
use App\Livewire\Application\Depense\MyEmprunt;
use App\Livewire\Application\Inscription\List\ListAllInscription;
use App\Livewire\Application\Inscription\List\ListInscriptionByClasse;
use App\Livewire\Application\Inscription\List\ListStudentResponsable;
use App\Livewire\Application\Parents\ListParents;
use App\Livewire\Application\Payment\MainLatePaymeent;
use App\Livewire\Application\Rapport\Payment\RapportCostEtat;
use App\Livewire\Application\Tarification\CostTarification;
use App\Livewire\Application\User\MyAccount;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::middleware(['auth', 'route-access-checker'])->group(function () {
    Route::get('/', ApplicationLinkController::class)->name('main');
    Route::get('/app-create-school', CreateSchoolController::class)->name('school.create');
    //DASHBOARD REFACTORING
    Route::prefix('dashboard')->group(function () {
        Route::get('main', MainDashboard::class)->name('dashboard.main');
    });
    //INSCRIPTION REFACTORING
    Route::prefix('inscription')->group(function () {
        Route::get('new-inscription', NewInscription::class)->name('inscription.new');
        Route::get('new-reinscription', NewReinscription::class)->name('reinscription.new');
        Route::get('valide-payment', ValideInscriptionPayment::class)->name('inscription.payment.valide');
        Route::get('list-all-inscription', ListAllInscription::class)->name('inscription.list.all');
        Route::get('lis-inscription-by-classe/{classe}', ListInscriptionByClasse::class)->name('inscription.list.by.classe');
    });
    //Payment routes inscription-by-classe
    Route::prefix('payment')->group(function () {
        Route::get('other-cost-payment', OtherCostPayment::class)->name('payment.other.cost');
        Route::get('control-payment', MainControlPayment::class)->name('payment.control');
        Route::get('late', MainLatePaymeent::class)->name('payment.late');
    });
    //Settings links route
    Route::prefix('settings')->group(function () {
        Route::get('app-link-settings', AppLinkSettings::class)->name('settings.app.links');
        Route::get('app-settings', AppSettings::class)->name('settings.app');
    });
    //Rapport payment
    Route::prefix('rapport')->group(function () {
        Route::get('payments', PaymentRapport::class)->name('rapport.payments');
        Route::get('payment-all-receipt-by-section', RapportAllReceiptBySection::class)->name('rapport.receipt.all.by.section');
        Route::get('inscription-by-classe', RapportInscriptionByClasse::class)->name('rapport.inscription.by.classe');
        Route::get('payment-cost-etat', RapportCostEtat::class)->name('rapport.payment.cost.etat');
    });

    //Depense
    Route::prefix('depense')->group(function () {
        Route::get('all', MyDepense::class)->name('depense.all');
        Route::get('emprunt', ListEmprunt::class)->name('depense.emprunt');
    });

    //Tarifications
    Route::prefix('tarification')->group(function () {
        Route::get('cost', CostTarification::class)->name('tarification.cost.general');
    });

    //Parents
    Route::prefix('parent')->group(function () {
        Route::get('list', ListParents::class)->name('parent.list');
    });
    //User
    Route::prefix('user')->group(function () {
        Route::get('my-account', MyAccount::class)->name('user.account');
    });


    //Prin inscription
    Route::prefix('printing')->group(function () {
        Route::prefix('inscription')->group(function () {
            Route::controller(ListInscriptionController::class)->group(function () {
                Route::get('list-by-classe/{classe}', 'printListInscriptionByClasse')->name('print.list.inscription.by.classe');
            });
        });
    });

    //Pint rapport payment cost
    Route::prefix('printing')->group(function () {
        Route::prefix('rapport-inscription')->group(function () {
            Route::controller(RapportInscriptionPaymentPrintingController::class)->group(function () {
                Route::get('by-date/{date}/{scolaryYear}/{currency}', 'printRepportInscriptionPaymentByDate')->name('print.rapport.inscription.payment.by.day');
            });
        });
    });
    //pRINT RECEIPT
    Route::prefix('print-receipt')->group(function () {
        Route::controller(PrintingReceiptController::class)->group(function () {
            Route::get('inscription/{inscription}/{currency}', 'printReceiptInscription')->name('receipt.inscription');
            Route::get('payment/{payment}/{currency}', 'printReceiptPayment')->name('receipt.payment');
        });
    });
    //Print depense and emprunt
    Route::prefix('print-depense-emprunt')->group(function () {
        Route::controller(PrintingDepenseAndEmpruntController::class)->group(function () {
            Route::get('depense/{month}', 'printDepenseMonth')->name('depense.month');
            Route::get('emprunt/{month}', 'printEmpruntByMonth')->name('emprunt.month');
        });
    });
});
