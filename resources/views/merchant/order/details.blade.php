@push('title')
    <title>New Order List | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <style>
        .pagination {
            display: flex;
            justify-content: end;
        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Order Items</h3>
                    <div class="block-options">
                        <div class="block-options-item p-2 px-3 rounded" style="background: #beccf0">
                            <span class="fw-bold">Invoice:</span> &nbsp;
                            <small>
                                <a class="text-dark fw-bold"
                                    href="{{ route('invoice', ['shopUrl' => $shopUrl, 'order_id' => $order_id]) }}"
                                    target="_blank" id="copyLink"
                                    data-clipboard-text="{{ url("/{$shopUrl}/invoice/{$order_id}") }}">
                                    {{ url("/{$shopUrl}/invoice/{$order_id}") }}
                                </a> &nbsp; &nbsp;
                                <i class="fas fa-copy fa-xl" style="cursor: pointer;" id="copy_btn"></i>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full overflow-x-auto">
                    <div class="row">
                        @foreach ($products as $key => $product)
                            <div class="col-md-3 m-auto">
                                <div class="card mt-3">
                                    <div class="card-header d-flex justify-content-around">
                                        <img width="150" src="{{ asset($product->products->preview) }}" alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <label class="form-label m-0 d-flex justify-content-between"><span>Product
                                                    Name</span> <small
                                                    class="text-muted">#{{ $product->products->product_code }}</small></label>
                                            <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                {{ $product->products->name }}</p>
                                        </div>
                                        <div class="">
                                            <label class="form-labe m-0l">Product Variant</label>
                                            <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                {{ $product->attribute->name }} - {{ $product->color->name }}</p>
                                        </div>
                                        <div class="">
                                            <label class="form-label m-0">Quantity</label>
                                            <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                {{ $product->quantity }}</p>
                                        </div>
                                        <div class="">
                                            <label class="form-label m-0">Condition</label>
                                            <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                {{ $product->products->condition }}</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label m-0">Product Price</label>
                                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                    &#2547; {{ number_format($product->price) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label m-0">Total Price</label>
                                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                                    &#2547; {{ number_format($product->quantity * $product->price) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Order Summary</h3>
                </div>
                <div class="block-content block-content-full overflow-x-auto">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <label for="" class="form-label fs-lg">Discount</label>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Coupon Code</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->coupon_code ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Total Discount</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->discount ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="" class="form-label fs-lg">Shipping</label>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Shipping Method</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->charge == 100 ? 'Inter City' : 'Outside' }}
                                </p>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Shipping Charge</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->charge }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="" class="form-label fs-lg">Payment</label>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Payment Method</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2 text-uppercase">
                                    {{ $order?->payment_method }}
                                </p>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Total Amount</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->total }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Customer Information</h3>
                </div>
                <div class="block-content block-content-full overflow-x-auto">
                    <div class="row">

                        <div class="col-6 col-md-4">
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Customer Name</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->customer->name }}
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Customer Email</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->customer->email }}
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Customer Phone</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->customer->phone }}
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Customer Address</label>
                                <p class="card-title border py-1 px-2 rounded fw-semibold mb-2">
                                    {{ $order?->customer->address }}
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-2">
                                <label class="form-label fs-sm mb-0">Order Notes</label>
                                <textarea name="" id="" cols="30" rows="5" class="form-control" readonly>{{ $order?->billing->note }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Delivery Information</h3>
                </div>
                <div class="block-content block-content-full overflow-x-auto">
                    <div class="row items-push">

                        @if ($redx)
                            <div class="col-md-2">
                                <div class="form-check form-block">
                                    <input class="form-check-input" checked type="radio" id="redx_input"
                                        name="delivery">
                                    <label class="form-check-label" for="redx_input">
                                        <span class="d-flex align-items-center">
                                            <img class="img-avatar img-avatar48"
                                                src="http://127.0.0.1:8000/assets/media/photos/redx.png"
                                                alt="Redx Delivery">
                                            <span class="ms-2">
                                                <span class="fw-bold">Redx</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if ($steadfast)
                            <div class="col-md-2">
                                <div class="form-check form-block">
                                    <input class="form-check-input" {{ !$redx ? 'checked' : '' }} type="radio"
                                        value="" id="steadfast_input" name="delivery">
                                    <label class="form-check-label" for="steadfast_input">
                                        <span class="d-flex align-items-center">
                                            <img class="img-avatar img-avatar48"
                                                src="{{ asset('assets') }}/media/photos/steadfast.jpeg" alt="">
                                            <span class="ms-2">
                                                <span class="fw-bold">Steadfast</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if ($pathao)
                            <div class="col-md-2">
                                <div class="form-check form-block">
                                    <input class="form-check-input" {{ !$steadfast ? 'checked' : '' }} type="radio"
                                        id="pathao_input" name="delivery">
                                    <label class="form-check-label" for="pathao_input">
                                        <span class="d-flex align-items-center">
                                            <img class="img-avatar img-avatar48"
                                                src="{{ asset('assets') }}/media/photos/pathao.png" alt="">
                                            <span class="ms-2">
                                                <span class="fw-bold">Pathao</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check form-block">
                                <button class="btn btn-primary">Send to Delivery</button>
                            </div>
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div class="modal fade redx" id="redx" tabindex="-1" aria-labelledby="redx"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-popin" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-transparent mb-0">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Modal Title (Redx)</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content fs-sm">
                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                            adipiscing
                                            luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus
                                            lobortis tortor
                                            tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec
                                            taciti vestibulum
                                            quis in sit varius lorem sit metus mi.</p>
                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                            adipiscing
                                            luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus
                                            lobortis tortor
                                            tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec
                                            taciti vestibulum
                                            quis in sit varius lorem sit metus mi.</p>
                                    </div>
                                    <div class="block-content block-content-full text-end bg-body">
                                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-bs-dismiss="modal">Perfect</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal steadfast" id="steadfast" tabindex="-1" aria-labelledby="steadfast" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Send Delivery to Steadfast</h3>
                                </div>
                                <div class="block-content block-content-full overflow-x-auto">
                                    <div class="row">

                                        <form action="{{ route('steadfast.delivery') }}" method="POST">
                                            @csrf
                                            <div class="col-6 col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">Invoice ID</label>
                                                    <input type="text" class="form-control w-50" name="invoice" readonly value="{{ $order->order_id }}">
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">*Recipient name</label>
                                                    <input type="text" class="form-control" name="recipient_name" readonly value="{{ $order->shipping->ship_name}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">*Recipient phone</label>
                                                    <input type="text" class="form-control" name="recipient_phone" readonly value="{{ $order->shipping->ship_phone}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">*Recipient Address</label>
                                                    <input type="text" class="form-control" name="recipient_address" readonly value="{{ $order->shipping->ship_address}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">*Amount to Collect</label>
                                                    <input type="text" class="form-control" name="cod_amount" readonly value="{{ $order->total}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label fs-sm mb-0">Order Notes</label>
                                                    <textarea name="note" id="" cols="30" rows="5" class="form-control" readonly>{{ $order?->billing->note }}</textarea>
                                                </div>
                                            </div>
                                            {{-- Hidden Input --}}
                                            <input type="text" name="order_id" value="{{ $order->order_id }}" hidden>
                                            <div class="col-12 col-md-12 mt-5">
                                                <button type="submit" class="btn btn-sm btn-primary w-100"
                                                    data-bs-dismiss="modal">Send Delivery Request</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="modal fade pathao" id="pathao" tabindex="-1" aria-labelledby="pathao"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-slideleft" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-transparent mb-0">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Modal Title (Pathao)</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content fs-sm">
                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                            adipiscing
                                            luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus
                                            lobortis tortor
                                            tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec
                                            taciti vestibulum
                                            quis in sit varius lorem sit metus mi.</p>
                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                            adipiscing
                                            luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus
                                            lobortis tortor
                                            tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec
                                            taciti vestibulum
                                            quis in sit varius lorem sit metus mi.</p>
                                    </div>
                                    <div class="block-content block-content-full text-end bg-body">
                                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-bs-dismiss="modal">Perfect</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>

    <script>
        // Add click event listener to the copy button
        document.getElementById('copy_btn').addEventListener('click', function() {
            // Get the text from the data-clipboard-text attribute
            var textToCopy = document.getElementById('copyLink').getAttribute('data-clipboard-text');

            // Create a temporary textarea element
            var textArea = document.createElement('textarea');
            textArea.value = textToCopy;
            document.body.appendChild(textArea);

            // Select and copy the text
            textArea.select();
            document.execCommand('copy');

            // Remove the temporary textarea
            document.body.removeChild(textArea);

            // Optionally, show a success message or change the icon
            showToast('Copied to clipboard', 'success');
        });
    </script>
    <script>
        document.querySelector('.btn-primary').addEventListener('click', function() {
            // Checked radio button ber kora
            const checkedDelivery = document.querySelector('input[name="delivery"]:checked');

            if (checkedDelivery) {
                // Checked radio button-er ID theke corresponding modal-er ID determine kora
                const modalId = checkedDelivery.id.replace('_input', '');
                const modal = document.getElementById(modalId);

                if (modal) {
                    // Modal show kora
                    const bootstrapModal = new bootstrap.Modal(modal);
                    bootstrapModal.show();
                }
            } else {
                alert('Please select a delivery option first!');
            }
        });
    </script>
@endpush
