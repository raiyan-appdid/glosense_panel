@extends('layouts/contentLayoutMaster')

@section('title', 'DeliveryCharge')
@section('page-style')
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Manage Delivery Charges">
                    <x-form successCallback="refresh" id="deliveryCharge" method="POST" :route="route('admin.deliverycharges.store')" action="#">
                        <div class="col-md-6 col-12 ">
                            <x-input name="within" value="{{ $deliverycharges['within'] }}" />
                            @error('within')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="out_of" type="number" value="{{ $deliverycharges['out_of'] }}" />
                            @error('out_of')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </x-form>
                </x-card>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script>
        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }

        function refresh() {
            location.reload();
        }
    </script>
@endsection
