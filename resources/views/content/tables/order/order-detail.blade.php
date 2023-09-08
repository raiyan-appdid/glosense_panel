@extends('layouts/contentLayoutMaster')

@section('title', 'Orders Detail')
@section('page-style')
@endsection

@section('content')

    @php
        $x = 1;
        $shipping_detail = json_decode($order->shipping_address);
    @endphp



    <section>
        <div class="row">

            <div class="col-md-12 col-12">
                <x-card title="Order Detail">
                    <div class="row">
                        <div class="col-lg-4 col-12 text-center">
                            <div>
                                <p><strong>Name : </strong>{{ $shipping_detail->name }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <div>
                                <p><strong>Email : </strong>{{ $order->user->email }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <div>
                                <p><strong>Mobile : </strong>{{ $shipping_detail->mobile }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 col-12">
                            <table class="table table-striped table-bordered table-responsive">
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($order->orderItem as $key => $v)
                                    <tr>
                                        <td>
                                            {{ $x++ }}
                                        </td>

                                        <td>
                                            <a href="{{ route('product-detail', $v->product->slug) }}" target="_blank"><span
                                                    class="badge badge-light-primary mb-1">{{ $v->product_name ?? 'N/A' }}</span></a>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary mb-1">{{ $v->quantity }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary mb-1">{{ $v->discounted_price }}</span>
                                        </td>
                                        <td>
                                            {{ $v->quantity * $v->discounted_price }}
                                            @php
                                                $total += $v->quantity * $v->discounted_price;
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if ($order->tracking_code != null)
                            <div class="col-lg-6 col-6 mt-5 text-right">
                                <a href="{{ route('admin.orders.send-invoice') }}"
                                    class="btn btn-outline-danger text-nowrap px-1 waves-effect send">Send
                                    Invoice</a>
                            </div>
                        @endif
                        <div class="col-lg-3 col-3 mt-5 text-right">
                            <h4>Total : {{ $total }}</h4>
                        </div>
                        <div class="col-lg-3 col-3 mt-5 text-right">
                            <h4>Discount : {{ $order->promocode_discount }}</h4>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.5/dist/notiflix-aio-3.2.5.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.send', function() {
                const data = @json($order);
                const order_id = data.id;
                Notiflix.Loading.standard('Sending invoice...');
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.orders.send-invoice') }}",
                    data: {
                        id: order_id
                    },
                    success: function(response) {
                        console.log(response);
                        Notiflix.Loading.remove();
                        console.log(response, status);
                        if (response.success) {
                            Notiflix.Notify.success('Invoice sent successfully!');
                            setTimeout(function() {
                                location.reload();
                                // location.replace(response.route);
                            }, 2000);
                        } else {
                            Notiflix.Notify.failure('Something went wrong');
                        }
                    }
                });
            });
        });
    </script>
@endsection
