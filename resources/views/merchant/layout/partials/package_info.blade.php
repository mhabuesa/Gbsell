@php
    $shop = Auth::guard('merchant')->user()->shop;
    $expiry_date = $shop ? $shop->expiry_date : null;
    $remaining_days = null;

    if ($expiry_date) {
        $remaining_days = (new DateTime($expiry_date))->diff(new DateTime())->days;
    }
@endphp
<div class="content content-boxed">
    @if ($expiry_date && $expiry_date < date('Y-m-d'))
        <div class="alert text-white bg-danger d-flex align-items-center justify-content-between" role="alert">
            <div class="flex-grow-1 me-3">
                <p class="mb-0">
                    You are not subscribed to any plan. Please <strong><a href="{{ route('subscription.index') }}" class="alert-link">Subscribe</a></strong> to a plan to unlock
                    everything.
                </p>
            </div>
            <div class="flex-shrink-0">
                <i class="fa fa-fw fa-exclamation-circle"></i>
            </div>
        </div>
    @elseif ($expiry_date && $remaining_days <= 5)
        <div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
            <div class="flex-grow-1 me-3">
                <p class="mb-0">
                    Your subscription is about to expire in <strong>{{ $remaining_days }}</strong> days. Please
                    renew it
                    to continue using our services.
                    <a class="alert-link" href="{{ route('subscription.index') }}">Renew Now</a>!
                </p>
            </div>
            <div class="flex-shrink-0">
                <i class="fa fa-fw fa-exclamation-circle"></i>
            </div>
        </div>
    @elseif ($expiry_date && $remaining_days <= 15 && Route::is(['merchant.dashboard', 'subscription.index']))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <p class="mb-0">
                Your subscription is about to expire in <strong>{{ $remaining_days }}</strong> days. Please renew it
                to continue using our services.
                <a class="alert-link" href="{{ route('subscription.index') }}">Renew Now</a>!
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif ($expiry_date && $remaining_days <= 29 && Route::is(['merchant.dashboard', 'subscription.index']))
        <div class="alert alert-success alert-dismissible" role="alert">
            <p class="mb-0">
                Your subscription is about to expire in <strong>{{ $remaining_days }}</strong> days. Please renew it
                to continue using our services.
                <a class="alert-link" href="{{ route('subscription.index') }}">Renew Now</a>!
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
