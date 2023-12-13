<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="newReinscription" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false"
        aria-labelledby="newReinscriptionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newReinscriptionLabel">
                        PASSE UNE NOUVELLE REINSCRIPTION
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='store'>
                    <div class="modal-body">
                        @if ($student)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{ $student->name }}</h6>
                                <h6><span class="text-bold text-info">
                                        Classe passée:{{$student->inscription->getStudentClasseName($student->inscription)}}</span></h6>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-form.label value="{{ __('Type option') }}" />
                                                        <x-select wire:model.live='classe_option_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($listClasseOption as $classOption)
                                                                <option value="{{ $classOption->id }}">
                                                                    {{$classOption->name}}
                                                                </option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('classe_option_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-form.label value="{{ __('Type inscription') }}" />
                                                        <x-select wire:model.live='cost_inscription_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($costInscriptionList as $cost)
                                                                <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('cost_inscription_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-form.label value="{{ __('Classe') }}" />
                                                        <x-select wire:model.live='classe_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($classeList as $classe)
                                                                <option value="{{ $classe->id }}">
                                                                    {{ $classe->name.'/'.$classe->optioName}}</option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('classe_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-form.label value="{{ __('Nom famiille') }}" />
                                                        <x-select wire:model.live='student_responsable_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($listStudentResponsable as $responsable)
                                                                <option value="{{ $responsable->id }}">{{ $responsable->name_responsable  }}</option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('classe_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        @foreach($listOldCostType as $cost)
                                            <div class="col-sm-4">
                                                <!-- checkbox -->
                                                <div class="form-group clearfix">
                                                    <div  class="icheck-primary d-inline">
                                                        <input type="checkbox" id="{{$cost->id}}"
                                                               wire:model.live="typeCostSelected" 
                                                               value="{{$cost->id}}">
                                                        <label for="{{$cost->id}}"
                                                               class="">
                                                            {{$cost->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Frais</th>
                                                @foreach($months as $month)
                                                    <th>{{$month}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listTypeCost as $type)
                                                <tr>
                                                    <td>{{$type->name}}</td>
                                                    @foreach($months as $m)
                                                        <td class="{{$type->getPaymentCheckerBgtatus($type->id,$student->inscription->id,$m)}}">
                                                            {{$type->getPaymentCheckerStatus($type->id,$student->inscription->id,$m)}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">Terminer</x-form.button>
                        <x-form.button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
