<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckerRedirectUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cucrrentRouteName = Route::currentRouteName();
        if (in_array($cucrrentRouteName, $this->userAccessRole()[auth()->user()->getRoleNames()[0]])) {
            return $next($request);
        } else {
            abort(403);
        }
    }


    public function userAccessRole()
    {
        return [
            'App-Admin' => [
                'filament.pages.dashboard',
                'main',
            ],
            'Super-Admin' => [
                'main',
                'filament.pages.dashboard',
                'school.create',
                'dashboard.main',
                'settings.app.links',
                'settings.app',
                'user.account'
            ],
            'Coordinator' => [
                'main',
                'dashboard.main',
                'rapport.payments',
                'rapport.inscription.by.classe',
                'inscription.payment.valide',
                'payment.other.cost',
                ' filament.pages.dashboard',
                'payment.control',
                'user.account',
                'inscription.list.by.classe',
            ],
            'Finance' => [
                'main',
                'dashboard.main',
                'inscription.payment.valide',
                'payment.other.cost',
                'rapport.payments',
                'rapport.inscription.by.classe',
                'print.rapport.payments',
                'payment.control',
                'rapport.receipt.all.by.section',
                'receipt.inscription',
                'receipt.payment',
                'print.rapport.inscription.payment.by.day',
                'depense.all',
                'payment.late',
                'tarification.cost.general',
                'depense.month',
                'emprunt.month',
                'parent.list',
                'user.account',
                'rapport.payment.cost.etat',
                'inscription.list.by.classe',
                'print.list.inscription.by.classe',
                'depense.emprunt',
                'movement.other',
                'payment.finance.repport',
                'payment.finance.repport.cost'
            ],
            'Secretary' => [
                'main',
                'dashboard.main',
                'inscription.new',
                'reinscription.new',
                'parent.list',
                'user.account',
                'inscription.list.all',
                'inscription.list.by.classe',
                'print.list.inscription.by.classe'
            ],
        ];
    }
}
