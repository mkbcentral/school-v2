<x-modal.build-modal-fixed idModal='paymentsByStudent' size='lg' headerLabel='LISTE PAIMENTS'
    headerLabelIcon='fas fa-eye'>
    <div class="modal-body">
        @if ($inscription)
            <div class="card p-2">
                <h6><span class="text-bold text-info">Nom:</span>{{ $inscription->student->name }}
                </h6>
                <h6><span class="text-bold text-info">Classe:
                        {{ $inscription->getStudentClasseName($inscription) }}</span>
                </h6>
            </div>
            @livewire('application.payment.list.list-payment-by-inscription', ['inscription' => $inscription])
        @endif
    </div>
</x-modal.build-modal-fixed>
