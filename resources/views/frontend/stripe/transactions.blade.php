<li class="second-libx1">
    <div class="price-tblebx11">
        <p class="datebx1">Date</p>
        <p class="forbx">For</p>
        <p class="amountbx">Amount</p>
    </div>
</li>
@if(isset($transactions) && $transactions->count())
    @foreach($transactions as $transaction)
        @php $isDebit = ($transaction->payment_type == 'debit') ? 1 : 0; @endphp
        <li>
            <div class="price-tblebx11">
                <p class="datebx1">{{date('M d, y', strtotime($transaction->created_at))}}</p>
                <p class="forbx">{{$transaction->description}}</p>
                <p class="amountbx @if($isDebit) red-amount @endif">@if($isDebit) -@endif${{round($transaction->amount, 2)}}</p>
            </div>
        </li>
    @endforeach
@else
    <li>
        <div>
            <p class="text-center">No Data Found</p>
        </div>
    </li>
@endif
