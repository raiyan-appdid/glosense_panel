@extends('layouts/contentLayoutMaster')

@section('title', 'Users')
@section('page-style')
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script>
        function setValue(data, modal) {
            // console.log(data);
            $(modal + ' #id').val(data.id);
            $(modal + ' #first_name').val(data.first_name);
            $(modal + ' #last_name').val(data.last_name);
            $(modal + ' #email').val(data.email);
            $(modal + ' #phone').val(data.phone);
            $(modal + ' #address').val(data.address);
            $(modal + ' [name=gender][value=' + data.gender + ']').prop('checked', true).trigger('change');
            $(modal).modal('show');
        }
    </script>
@endsection
