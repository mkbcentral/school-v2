<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Classe;
use App\Models\ClasseOption;
use App\Models\CostGeneral;
use App\Models\CostInscription;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\Inscription;
use App\Models\Rate;
use App\Models\Role;
use App\Models\School;
use App\Models\ScolaryYear;
use App\Models\Section;
use App\Models\TypeOtherCost;
use App\Models\User;
use App\Policies\ClasseOptionPolicy;
use App\Policies\ClassePolicy;
use App\Policies\CostGeneralPolicy;
use App\Policies\CostInscriptionPolicy;
use App\Policies\CurrencyPolicy;
use App\Policies\GenderPolicy;
use App\Policies\RatePolicy;
use App\Policies\RolePolicy;
use App\Policies\SchoolPolicy;
use App\Policies\ScolaryYearPolicy;
use App\Policies\SectionPolicy;
use App\Policies\TypeOtherCostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class=>UserPolicy::class,
        Role::class=>RolePolicy::class,
        Rate::class=>RatePolicy::class,
        Currency::class=>CurrencyPolicy::class,
        TypeOtherCost::class=>TypeOtherCostPolicy::class,
        CostGeneral::class=>CostGeneralPolicy::class,
        CostInscription::class=>CostInscriptionPolicy::class,
        Classe::class=>ClassePolicy::class,
        School::class=>SchoolPolicy::class,
        ScolaryYear::class=>ScolaryYearPolicy::class,
        Gender::class=>GenderPolicy::class,
        ClasseOption::class=>ClasseOptionPolicy::class,
        Section::class=>SectionPolicy::class

    ];

    /**
     * Register any auth / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('valid-payment', function () {
            $user=auth()->user();
            return $user->hasRole(['Finance','Coordinator']);
        });
        Gate::define('view-administration-panel', function () {
            $user=auth()->user();
            return $user->hasRole(['Super-Admin',]);
        });
        Gate::define('view-links-settings', function () {
            $user=auth()->user();
            return $user->hasRole(['App-Admin','Coordinator','Finance']);
        });
        Gate::define('edit-student-infos', function () {
            $user=auth()->user();
            return $user->hasRole(['Secretary']);
        });
        Gate::define('edit-classe-inscription', function () {
            $user=auth()->user();
            return $user->hasRole(['Secretary','Finance']);
        });
        Gate::define('view-total-amount', function () {
            $user=auth()->user();
            return $user->hasRole(['Coordinator','Finance']);
        });
        Gate::define('view-depense-emprunt', function () {
            $user=auth()->user();
            return $user->hasRole(['Finance']);
        });
        $this->registerPolicies();

    }
}
