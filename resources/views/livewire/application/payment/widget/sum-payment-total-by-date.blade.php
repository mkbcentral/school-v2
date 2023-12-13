<div>
    <x-widget.loading-circular-md/>
    @if ($payments==null)
   
    @else
    <div class="btn-group" wire:loading.class='d-none'>
        @foreach ($payments as $payment)
        <button type="button" class="btn btn-primary text-bold">
            <h4>{{$payment->currency.' '.app_format_number($payment->total)}}</h4>
        </button>
        @endforeach
        </div>
    @endif
    
</div>
