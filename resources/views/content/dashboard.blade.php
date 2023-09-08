@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')
@section('page-style')
    <style>
        .avatar svg {
            height: 20px;
            width: 20px;
            font-size: 1.45rem;
            flex-shrink: 0;
        }

        .dark-layout .avatar svg {
            color: #fff;
        }

        .cursor {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <section id="dashboard-card">
        <div class="row match-height">
            <div style="cursor: pointer;" onclick="location.href='{{ route('admin.users.index') }}';"
                class="col-lg-3 col-md-3 col-sm-3 ">
                <x-card>
                    <h2 class="text-center">{{ $users }}</h2>
                    <p>
                    <h4 class="text-center"><span class="badge badge-light-info">Total Users</span></h4>
                    </p>
                </x-card>
            </div>
            <div style="cursor: pointer;" onclick="location.href='{{ route('admin.products.index') }}';"
                class="col-lg-3 col-md-3 col-sm-3 ">
                <x-card>
                    <h2 class="text-center">{{ $products }}</h2>
                    <p>
                    <h4 class="text-center"><span class="badge badge-light-info">Total Products</span></h4>
                    </p>
                </x-card>
            </div>
            <div style="cursor: pointer;" onclick="location.href='{{ route('admin.enquirys.index') }}';"
                class="col-lg-3 col-md-3 col-sm-3 ">
                <x-card>
                    <h2 class="text-center">{{ $enquiry }}</h2>
                    <p>
                    <h4 class="text-center"><span class="badge badge-light-info">Total Enquiry</span></h4>
                    </p>
                </x-card>
            </div>
            <div style="cursor: pointer;" onclick="location.href='{{ route('admin.promocodes.index') }}';"
                class="col-lg-3 col-md-3 col-sm-3 ">
                <x-card>
                    <h2 class="text-center">{{ $promocode }}</h2>
                    <p>
                    <h4 class="text-center"><span class="badge badge-light-info">Total Promocode</span></h4>
                    </p>
                </x-card>
            </div>
            <div style="cursor: pointer;" onclick="location.href='{{ route('admin.testimonials.index') }}';"
                class="col-lg-3 col-md-3 col-sm-3 ">
                <x-card>
                    <h2 class="text-center">{{ $testimonilas }}</h2>
                    <p>
                    <h4 class="text-center"><span class="badge badge-light-info">Total Testimonials</span></h4>
                    </p>
                </x-card>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            <div class="col-lg-4 col-sm-6 col-12">

            </div>
            {{-- <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header align-items-start">
                        <div>
                            <h4 class="card-title mb-25">Orders</h4>                            
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="order-graph"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header align-items-start">
                        <div>
                            <h4 class="card-title mb-25">Users</h4>                            
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="user-graph"></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('page-script')
    <script></script>
@endsection
