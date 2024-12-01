@extends('layouts.frontend')
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h1 class="text-center">Cart</h1>
            </div>
            <div class="mb-10 cart-table">
                <table class="table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-name">Variant</th>
                            <th class="product-name">Color</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity w-lg-15">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data ?? []) > 0)
                            @foreach ($data as $product)
                                <tr class="product-row">
                                    <td class="text-center">
                                        <a href="#" class="text-gray-32 font-size-26 js-delete-product"
                                            data-product_id="{{ $product['product_id'] }}"
                                            data-shop_url="{{ $shop->url }}"
                                            data-attribute_id="{{ $product['attribute_id'] }}"
                                            data-color_id="{{ $product['color_id'] }}">×</a>

                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="#"><img class="img-fluid max-width-100 p-1"
                                                src="{{ asset($product['preview']) }}" alt="Image Description"></a>
                                    </td>

                                    <td data-title="Product">
                                        <a href="javascript:void(0)" class="text-gray-90">{{ $product['product_name'] }}</a>
                                    </td>
                                    <td data-title="Product">
                                        <a class="text-gray-90">{{ $product['attribute'] }}</a>
                                    </td>
                                    <td data-title="Product">
                                        <a href="javascript:void(0)" class="text-gray-90">{{ $product['color'] }}</a>
                                    </td>

                                    <td data-title="Price">
                                        <span class="price cart_price">{{ $product['current_price'] }}</span>
                                    </td>

                                    <td data-title="Quantity">
                                        <span class="sr-only">Quantity</span>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input
                                                        class="js_result quantity cart_quantity form-control h-auto border-0 rounded p-0 shadow-none"
                                                        type="text" value="{{ $product['quantity'] }}"
                                                        data-product-id="{{ $product['product_id'] }}"
                                                        data-shop-url="{{ $shop->url }}"
                                                        data-attribute-id="{{ $product['attribute_id'] }}"
                                                        data-color-id="{{ $product['color_id'] }}">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="js_minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="js_plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>

                                    <td data-title="Total">
                                        <span class="total cart_total">৳
                                            {{ $product['current_price'] * $product['quantity'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h4>Your cart is empty!</h4>
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="8" class="border-top space-top-2 justify-content-center">
                                <div class="pt-md-3">
                                    <div class="d-block d-md-flex flex-center-between">
                                        <div class="mb-3 mb-md-0 w-xl-40">

                                        </div>
                                        <div class="d-md-flex">
                                            <a href="{{ route('checkout', $shop->url) }}"
                                                class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Proceed
                                                to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-8 cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                        <div class="border-bottom border-color-1 mb-3">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                        </div>
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td data-title="Subtotal">
                                        <span class="amount subtotal">৳ </span>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td data-title="Shipping">
                                        <span class="amount" id="shipping_charge">Flat Rate: ৳100</span>
                                        <div class="mt-1">
                                            <a class="font-size-12 text-gray-90 text-decoration-on underline-on-hover font-weight-bold mb-3 d-inline-block"
                                                data-toggle="collapse" href="#collapseExample" role="button"
                                                aria-expanded="false" aria-controls="collapseExample">
                                                Shipping Destination
                                            </a>
                                            <div class="collapse mb-3" id="collapseExample">
                                                <div class="form-group mb-4">
                                                    <select
                                                        class="js-select selectpicker dropdown-select right-dropdown-0-all w-100"
                                                        data-style="bg-white font-weight-normal border border-color-1 text-gray-20"
                                                        id="shipping_option" onchange="updateShipping(this.value)">
                                                        <option selected value="inter">Inter City</option>
                                                        <option value="outside">Outside City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Discount</th>
                                    @if(session('discount'))
                                        <td data-title="Subtotal">
                                            <span class="amount" id="discount">৳ -{{ session('discount') }} ({{ session('discount') > 0 ? 'Applied' : 'No discount' }})</span>
                                        </td>
                                    @else
                                    <td data-title="Subtotal">
                                        <span class="amount" id="discount">৳ 0</span>
                                    </td>
                                    @endif
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td data-title="Total"><strong><span class="amount" id="total"></span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button"
                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed
                            to checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update the cart total for a specific product
            function updateCartTotal(quantityInput) {
                const row = quantityInput.closest('tr');
                const cartPrice = parseFloat(row.querySelector('.cart_price').textContent.replace('৳', '').trim());
                const cartQuantity = parseInt(quantityInput.value);

                // Calculate the total price for this row
                const cartTotal = cartPrice * cartQuantity;

                // Update the cart total for this row
                row.querySelector('.cart_total').textContent = '৳ ' + cartTotal.toFixed(2);
            }

            // Function to update the subtotal
            function updateSubtotal() {
                let totalAmount = 0;

                // Loop through all visible cart_total elements and add up their values
                document.querySelectorAll('.cart_total').forEach(function(totalElement) {
                    if (totalElement.closest('tr').style.display !==
                        'none') { // Check if the row is visible
                        let total = parseFloat(totalElement.textContent.replace('৳', '').trim());
                        totalAmount += total; // Add the value to the totalAmount
                    }
                });

                console.log('Updated subtotal:', totalAmount); // Log the updated subtotal

                // Update all subtotal elements with the total amount
                document.querySelectorAll('.subtotal').forEach(function(subtotalElement) {
                    subtotalElement.textContent = '৳ ' + totalAmount.toFixed(2);
                });
            }

            // Function to update quantity and handle server-side and cart total
            function updateQuantity(input, isIncrement) {
                const quantityInput = input.closest('.js-quantity').querySelector('.js_result');
                let quantity = parseInt(quantityInput.value) || 0;
                const maxQuantity = 999; // optional: max limit
                const minQuantity = 1; // optional: min limit

                // Increment or decrement the quantity
                if (isIncrement) {
                    quantity = Math.min(quantity + 1, maxQuantity);
                } else {
                    quantity = Math.max(quantity - 1, minQuantity);
                }

                // Update the quantity input field
                quantityInput.value = quantity;

                // Get product data
                const productId = quantityInput.getAttribute('data-product-id');
                const shopUrl = quantityInput.getAttribute('data-shop-url');
                const attributeId = quantityInput.getAttribute('data-attribute-id');
                const colorId = quantityInput.getAttribute('data-color-id');

                // Update cookies
                const cookieKey = `${shopUrl}_${productId}_${attributeId}_${colorId}`;
                document.cookie = `${cookieKey}=${quantity}; path=/;`;

                // Send AJAX request to update server-side
                updateQuantityOnServer({
                    product_id: productId,
                    shop_url: shopUrl,
                    attribute_id: attributeId,
                    color_id: colorId,
                    quantity: quantity
                });

                // Update the cart total and subtotal after quantity change
                updateCartTotal(quantityInput);
                updateSubtotal();
            }

            // Function to send AJAX request for quantity update
            function updateQuantityOnServer(data) {
                const url = `/${data.shop_url}/updateCart`; // Dynamic URL with shopUrl

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            console.log('Quantity updated successfully');
                        } else {
                            console.error('Failed to update quantity');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Function to delete product from cart
            function deleteProduct(productId, shopUrl, attributeId, colorId) {
                const cookieKey = `${shopUrl}_${productId}_${attributeId}_${colorId}`;

                // Delete the cookie by setting it to an expired date
                document.cookie = `${cookieKey}=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT`;

                // Send AJAX request to remove product from server-side cart
                const url = `/${shopUrl}/deleteProduct`; // Dynamic URL with shopUrl

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            shop_url: shopUrl,
                            attribute_id: attributeId,
                            color_id: colorId
                        })
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            console.log('Product deleted successfully');

                            // Find the row and hide it
                            const row = document.querySelector(
                                `[data-product-id="${productId}"][data-shop-url="${shopUrl}"][data-attribute-id="${attributeId}"][data-color-id="${colorId}"]`
                                ).closest('tr');
                            row.style.display = 'none';

                            // Update the subtotal after deletion
                            updateSubtotal();
                        } else {
                            console.error('Failed to delete product');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Event listeners for increment and decrement buttons
            document.querySelectorAll('.js_plus').forEach(btn => {
                btn.addEventListener('click', function() {
                    updateQuantity(this, true);
                });
            });

            document.querySelectorAll('.js_minus').forEach(btn => {
                btn.addEventListener('click', function() {
                    updateQuantity(this, false);
                });
            });

            // Event listener for quantity input field change
            document.querySelectorAll('.cart_quantity').forEach(function(inputElement) {
                inputElement.addEventListener('input', function() {
                    updateCartTotal(inputElement); // Update the cart total for this row
                    updateSubtotal(); // Recalculate and update all subtotals
                });
            });

            // Event listener for delete button
            document.querySelectorAll('.js-delete-product').forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();

                    const productId = this.getAttribute('data-product_id');
                    const shopUrl = this.getAttribute('data-shop_url');
                    const attributeId = this.getAttribute('data-attribute_id');
                    const colorId = this.getAttribute('data-color_id');

                    // Call deleteProduct function
                    deleteProduct(productId, shopUrl, attributeId, colorId);
                });
            });

            // Initial subtotal calculation when the page is loaded
            updateSubtotal();
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update shipping charge based on selected option
            function updateShippingCharge() {
                const shippingOption = document.getElementById('shipping_option').value; // Get selected option
                const shippingChargeElement = document.getElementById('shipping_charge');

                // Update shipping charge based on selected value
                if (shippingOption === 'inter') {
                    shippingChargeElement.textContent = 'Flat Rate: ৳100';
                } else if (shippingOption === 'outside') {
                    shippingChargeElement.textContent = 'Flat Rate: ৳150';
                }
            }

            // Event listener for shipping option change
            const shippingOptionElement = document.getElementById('shipping_option');
            shippingOptionElement.addEventListener('change', updateShippingCharge);

            // Initial call to set the shipping charge on page load
            updateShippingCharge();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to calculate and update the total amount
            function calculateTotal() {
                const subtotalElement = document.querySelector('.subtotal');
                const shippingChargeElement = document.getElementById('shipping_charge');
                const discountElement = document.getElementById('discount');
                const totalElement = document.getElementById('total');

                // Parse values from elements
                const subtotal = parseFloat(subtotalElement.textContent.replace('৳', '').trim()) || 0;
                const shippingCharge = parseFloat(shippingChargeElement.textContent.replace(/Flat Rate: ৳/, '')
                    .trim()) || 0;
                const discount = parseFloat(discountElement.textContent.replace('৳', '').trim()) || 0;

                // Check if subtotal is 0
                if (subtotal === 0) {
                    totalElement.textContent = ''; // Hide total if subtotal is 0
                    return; // Exit the function
                }

                // Calculate total
                const total = subtotal + shippingCharge - discount;

                // Update total element
                totalElement.textContent = '৳ ' + total.toFixed(2);
            }

            // Function to update shipping charge
            function updateShippingCharge() {
                const shippingOption = document.getElementById('shipping_option').value; // Get selected option
                const shippingChargeElement = document.getElementById('shipping_charge');

                // Update shipping charge based on selected value
                if (shippingOption === 'inter') {
                    shippingChargeElement.textContent = 'Flat Rate: ৳100';
                } else if (shippingOption === 'outside') {
                    shippingChargeElement.textContent = 'Flat Rate: ৳150';
                }

                // Recalculate total after shipping charge change
                calculateTotal();
            }

            // Add dynamic listener for subtotal changes
            const observer = new MutationObserver(function() {
                calculateTotal(); // Recalculate total if subtotal changes
            });

            const subtotalElement = document.querySelector('.subtotal');
            observer.observe(subtotalElement, {
                childList: true,
                characterData: true,
                subtree: true
            });

            // Event listeners for changes
            const shippingOptionElement = document.getElementById('shipping_option');
            shippingOptionElement.addEventListener('change', updateShippingCharge);

            // If discount changes dynamically, recalculate total
            const discountElement = document.getElementById('discount');
            discountElement.addEventListener('input', calculateTotal); // Assuming discount is an editable field

            // Recalculate total on page load
            calculateTotal();
        });
    </script>



    <script>
        $('#applyCouponButton').on('click', function() {
            let couponCode = $('#couponCodeInput').val();
            let shopUrl = $('#shopUrlInput').val(); // Shop URL as input

            $.ajax({
                url: '/' + shopUrl + '/applyCoupon', // Dynamic URL
                type: 'POST',
                data: {
                    coupon_code: couponCode,
                    shop_url: shopUrl,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#couponMessage').html(
                            `<span class="text-center alert alert-success form-control rounded">${response.message}</span>`
                            );
                        alert(response.message);
                    } else {
                        $('#couponMessage').html(
                            `<span class="text-center alert alert-danger form-control rounded">${response.message}</span>`
                            );
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Log error details
                    $('#couponMessage').html(
                        '<span class="text-center alert alert-danger form-control rounded">Something went wrong!</span>'
                        );
                }
            });
        });
    </script>

    {{-- <script>
    $(document).ready(function() {
        // Check if the coupon cookie exists
        var couponData = JSON.parse(Cookies.get('coupon')); // Assuming you're using js-cookie for cookies

        console.log('Coupon data:', couponData); // Log coupon data to confirm it's present

        if (couponData) {
            alert('Coupon code applied successfully!');

            // Get the subtotal from the page
            var subtotal = parseFloat($('.subtotal').text().replace('৳', '').trim()); // Adjust as needed for your format
            console.log('Subtotal:', subtotal); // Log subtotal value to verify

            // Get the min_amount from the coupon
            var minAmount = parseFloat(couponData.min_amount);
            console.log('Minimum Amount:', minAmount); // Log the minimum amount

            // Check if the subtotal is less than the min_amount
            if (subtotal < minAmount) {
                alert('Your subtotal is less than the minimum amount required for the coupon.');
                $('#couponMessage').html(`<span class="text-center alert alert-warning form-control rounded">Your subtotal is less than the minimum amount required for the coupon.</span>`);
                return; // Stop further execution if the subtotal is too low
            }

            // Check the coupon type and apply the discount
            var discountAmount = 0;

            if (couponData.type === 'flat') {
                alert('Flat discount applied: ' + couponData.discount);
                // Flat discount: subtract the discount value from subtotal
                discountAmount = parseFloat(couponData.discount);
            } else if (couponData.type === 'percentage') {
                alert('Percentage discount applied: ' + couponData.discount);
                // Percentage discount: calculate the percentage of the subtotal
                discountAmount = (subtotal * parseFloat(couponData.discount) / 100);
            }

            console.log('Discount Amount:', discountAmount); // Log the discount amount

            // Apply the discount to the subtotal
            var discountedTotal = subtotal - discountAmount;
            console.log('Discounted Total:', discountedTotal); // Log the discounted total

            // Update the discount row with the discount value
            $('#discount').text('৳ ' + discountAmount.toFixed(2));

            // Optionally, update the total after applying the discount
            $('.total').text('৳ ' + discountedTotal.toFixed(2)); // Update the total amount
        } else {
            console.log('No coupon found in cookies');
        }
    });
</script> --}}
@endpush
