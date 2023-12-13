<div>
    @livewire('application.inscription.forms.edit-inscription-form')
    @livewire('application.inscription.forms.edit-classe-and-inscription')
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fa fa-list" aria-hidden="true"></i> Liste des élèves</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Menu</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.main') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Liste élèves</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <x-search-input/>
                <div class="d-flex align-items-center">
                    <div class="form-group mr-2">
                        <x-form.label value="{{ __('Choisir une option') }}" />
                        <x-select wire:model.live='classe_option_id'>
                            <option value="">Choisir...</option>
                            @foreach ($classeOptionList as $classeOptionList)
                                <option value="{{ $classeOptionList->id }}">
                                    {{ $classeOptionList->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="form-group ">
                        <x-form.label value="{{ __('Filtrer par par classe') }}" />
                        <x-select wire:model.live='classe_id'>
                            <option value="">Choisir...</option>
                            @foreach ($classeList as $classe)
                                <option value="{{ $classe->id }}">
                                    {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
            </div>
        </div>
        @if ($inscriptions->isEmpty())
            <span class="text-success text-center p-4">
                <h4><i class="fa fa-database" aria-hidden="true"></i>
                    Aucune donnée trouvée !
                </h4>
            </span>
        @else
          
            <table class="table table-stripped table-sm">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th class="text-center">#</th>
                        <th>Noms élève</th>
                        <th class="text-center">Genre</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscriptions as $index => $inscription)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $inscription->student->name . 
                            '/' . $inscription->classe->name .
                             ' ' . $inscription->classe->classeOption->name }}
                            </td>

                            <td class="text-center">{{ $inscription->student->gender.' '.$inscription->id }}
                            </td>
                            <td class="text-center">
                                {{ $inscription->student->getAge($inscription->student->date_of_birth) }}
                            </td>
                            <td class="text-center">
                                @can('edit-student-infos')
                                    <x-form.button wire:click='edit({{ $inscription->student }})' class="btn-sm"
                                        type="button" data-toggle="modal" data-target="#formEditInscriptionModal">
                                        <i class="fas fa-edit text-primary"></i>
                                    </x-form.button>
                                    @if ($classe_option_id > 0)
                                        <x-form.button wire:click='editInscription({{ $inscription }})'
                                            class="btn-sm text-secondary" type="button" data-toggle="modal"
                                            data-target="#editClasseAnInscription">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </x-form.button>
                                    @endif

                                    <x-form.button class=" btn-sm" type="button"
                                        wire:click="delete({{ $inscription->id }})">
                                        <span wire:loading wire:target="delete({{ $inscription->id }})"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </x-form.button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          
        @endif
    </div>
</div>
