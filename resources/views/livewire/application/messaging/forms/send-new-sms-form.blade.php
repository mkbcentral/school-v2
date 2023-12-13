<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="sendNewSmsModal" tabindex="-1" role="dialog"
        aria-labelledby="sendNewSmsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendNewSmsModalLabel">
                        Envoyoi SMS
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='sendSMS'>
                    <div class="modal-body">
                        @if ($studentResponsable)
                            <div class="card">
                                <div class="card-header">
                                    <h4>Destinataire</h4>
                                </div>
                                <div class="card p-2">
                                    <h6><span class="text-bold text-info">Nom: </span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {{ $studentResponsable->name_responsable }}
                                    </h6>
                                    <h6><span class="text-bold text-info">Classe:</span>
                                        <i class="fa fa-phone" aria-hidden="true"></i> +243
                                        {{ $studentResponsable->phone }}
                                    </h6>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-form.label value="{{ __('Message') }}" />
                                <textarea wire:model='body' id="" class="form-control" cols="15" rows="5">
                                </textarea>
                                @error('body')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-form.button type="submit" class="btn btn-primary">
                            <span wire:loading wire:target="sendSMS"
                                class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            <i class="fab fa-telegram" aria-hidden="true"></i> Envoyer
                        </x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
