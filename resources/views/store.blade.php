    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <title>Watch Stores</title>
        <style>
            .select2-container--default .select2-selection--single {
                width: 240px !important;
            }

            .select2-search--dropdown {
                width: 240px !important;
            }

            .select2-results__option {
                width: 240px !important;
            }

            .select2-results__option select2-results__option--selectable select2-results__option--selected select2-results__option--highlighted {
                width: 240px !important;
            }
        </style>
    </head>

    <body>

        <center class="mt-5">
            <h1>Welcome Stores</h1>
        </center>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ isset($store) ? 'Edit Store' : 'Create Store' }}</div>

                        <div class="card-body">

                            {{-- <form id="storeForm" action="{{ isset($store) ? route('stores.update', $store->id) : route('stores.store') }}" method="POST"> --}}
                            <form id="storeForm" action="{{ route('stores.store') }}" method="POST">

                                @csrf
                                {{-- @if (isset($store))
                                @method('PUT')
                            @endif --}}

                                {{-- <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($store) ? $store->name : '') }}">
                            </div> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Adress</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_person">Contact Person</label>
                                            <input type="tel" name="contact_person" id="contact_person"
                                                class="form-control" value="{{ old('contact_person') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                        <label for="contact_person">Country</label>
                                        <select class="form-select" aria-label="Default select example">

                                        </select>
                                    </div>

                                    <div class="col-md-4  mt-4">
                                        <label for="contact_person">City</label>
                                        <select class="js-example-basic-single" name="city">
                                            <option value="AL">Alabama</option>
                                            ...
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_person">Land Mark</label>
                                            <input type="text" name="land_mark" id="land_mark" class="form-control"
                                                value="{{ old('land_mark') }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mt-5">
                                    {{-- <button id="submitBtn" type="submit"
                                    class="btn btn-primary">{{ isset($store) ? 'Update' : 'Create' }}</button> --}}
                                    <button id="submitBtn" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="showing_data mt-5">
            {{-- showig data --}}
            <table id="watch_store_list" class="display table mt-5">
                <thead>
                    <tr>
                        <th>{{ __('Store Name') }}</th>
                        <th>{{ __('Store Address') }}</th>
                        <th>{{ __('Contact Person') }}</th>
                        <th>{{ __('Country') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('Land Mark') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#storeForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        alert('Store ' + (response.status === 'created' ? 'created' :
                            'updated') + ' successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while ' + (status === 'error' ? 'creating' :
                            'updating') + ' the store.');
                    }
                });
            });

            $.ajax({
                url: '{{ route('stores.getData') }}',
                type: 'GET',
                success: function(data) {
                    $('#watch_store_list').DataTable({
                        data: data,
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'remaining_user_point'
                            }
                        ]
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });


            $('.js-example-basic-single').select2();
        });
    </script>

    </html>
