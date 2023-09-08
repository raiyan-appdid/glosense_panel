@extends('layouts/contentLayoutMaster')

@section('title', 'BusinessSetting')
@section('page-style')
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Business Settings">
                    <form id="businessSettings" method="POST" class="" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 ">
                                <x-input name="email" value="{{ $businessSettings['email'] ?? '' }}" />
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input name="phone" type="tel" maxlength="10"
                                    value="{{ $businessSettings['phone'] ?? '' }}" />
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input type="textarea" name="address" value="{{ $businessSettings['address'] ?? '' }}" />
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input type="textarea" name="footer_desc"
                                    value="{{ $businessSettings['footer_desc'] ?? '' }}" />
                                @error('footer_desc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input name="header_offer" value="{{ $businessSettings['header_offer'] ?? '' }}" />
                                @error('header_offer')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-divider text="Social Media Links" />

                            <div class="col-md-6 col-12 ">
                                <x-input name="facebook" type="url" value="{{ $businessSettings['facebook'] ?? '' }}" />
                                @error('facebook')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input name="instagram" type="url" value="{{ $businessSettings['instagram'] ?? '' }}" />
                                @error('instagram')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input name="youtube" type="url" value="{{ $businessSettings['youtube'] ?? '' }}" />
                                @error('youtube')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6 col-12 ">
                                <x-input name="twitter" type="url" value="{{ $businessSettings['twitter'] }}" />
                                @error('twitter')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <div class="col-md-6 col-12 ">
                                <x-input name="whatsapp" type="tel" maxlength="10" pattern="[1-9]{1}[0-9]{9}"
                                    value="{{ $businessSettings['whatsapp'] ?? '' }}" />
                                @error('whatsapp')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <x-button :isSubmit="true" text="Save" />
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.5/dist/notiflix-aio-3.2.5.min.js"></script>
    <script>
        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }


        $('#businessSettings').submit(function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            Notiflix.Loading.standard('Updating...');
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{ route('admin.businesssettings.store') }}",
                data: data,
                success: function(response) {
                    Notiflix.Loading.remove();
                    console.log(response);
                    if (response.success) {
                        Notiflix.Notify.success(response.success);
                        location.reload();
                    } else {
                        Notiflix.Notify.failure('Something went wrong!');
                    }
                },
                error: function(response) {
                    Notiflix.Loading.remove();
                    Notiflix.Notify.failure('Something went wrong!');
                    console.log(response);
                }
            });
        });
    </script>
@endsection
