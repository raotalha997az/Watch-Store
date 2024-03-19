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
                            <form id="storeForm" action="{{ route('stores.store') }}" method="POST">

                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id">
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
                                        <select class="form-select" id="country_id" onchange="getCity(this.value)"
                                            name="country_id" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4  mt-4">
                                        <label for="contact_person">City</label>
                                        <select class="js-example-basic-single" id="city_id"
                                            onchange="getLandMark(this.value)" name="city_id">
                                            <option value="">Select City</option>
                                            @foreach ($city as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_person">Land Mark</label>
                                            <select name="landmark_id" id="landmark_id">
                                                <option value="">Select Land Mark</option>
                                                @foreach ($landMark as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-primary"
                                                onclick="addLandMark()">+</button>
                                            <input type="text" name="landmark_name" id="landmark_name"
                                                class="form-control d-none">
                                            <button type="button" class="btn btn-danger d-none" id="landmarkBtn"
                                                onclick="removeLandMark()">Add</button>
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
                        <th>{{ __('Store #') }}</th>
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
        function addLandMark() {
            $('#landmark_name').removeClass('d-none');
            // $('#submitBtn').addClass('d-none');
            $('#landmarkBtn').removeClass('d-none');
            $('#landmarkBtn').addClass('d-block');

            var landmark_name = $('#landmark_name').val();
            var city_id = $('#city_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('stores.area') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    city_id: city_id,
                    name: landmark_name
                },
                success: function(response) {

                    console.log(response);
                    getCity(id);

                        // $('#landmark_id').append('<option value="' + response.id + '">' + response.name +
                        //     '</option>');
                        // $('#landmark_id').val(response.id);

                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        }



        function removeLandMark() {
            $('#landmark_name').addClass('d-none');
            $('#submitBtn').removeClass('d-none');
            $('#landmarkBtn').addClass('d-none');
            $('#landmarkBtn').removeClass('d-block');
            addLandMark();
        }

        function getLandMark(id) {
            console.log(id);
            $.ajax({
                url: '{{ route('landmarks.getData') }}',
                type: 'GET',
                data: {
                    city_id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#landmark_id').empty(); // Clear previous options
                    $.each(data, function(index, landmark) {
                        $('#landmark_id').append($('<option>', {
                            value: landmark.id,
                            text: landmark.name
                        }));
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function getCity(id) {
            console.log(id);
            $.ajax({
                url: '{{ route('cities.getData') }}',
                type: 'GET',
                data: {
                    country_id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#city_id').empty();
                    // getLandMark(id);
                    $.each(data, function(index, city) {
                        $('#city_id').append($('<option>', {
                            value: city.id,
                            text: city.name
                        }));
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function editStore(id) {
            $.ajax({
                url: '{{ route('stores.create_edit') }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#contact_person').val(data.contact_person);
                    $('#country_id').val(data.country_id);
                    $('#city_id').val(data.city_id);
                    $('#landmark_id').val(data.landmark_id);
                    getCity();
                    // getData();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while retrieving the store data.');
                }
            });
        }
        $(document).ready(function() {
            getData();
            $('#storeForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        $('#storeForm')[0].reset();
                        $('#id').val('');
                        getData();
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

            function getData() {
                $.ajax({
                    url: '{{ route('stores.getData') }}',
                    type: 'GET',
                    success: function(data) {
                        $('#watch_store_list').DataTable().destroy();
                        $('#watch_store_list').DataTable({
                            data: data,
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'name'
                                },
                                {
                                    data: 'address'
                                },
                                {
                                    data: 'contact_person'
                                },
                                {
                                    data: 'country_name'
                                },
                                {
                                    data: 'city_name'
                                },
                                {
                                    data: 'landmark_name'
                                },
                                {
                                    // Edit and Delete button column
                                    data: null,
                                    render: function(data, type, row) {
                                        return '<button onclick="editStore(' + row.id +
                                            ')" class="btn btn-primary btn-sm edit-btn" data-id="' +
                                            row.id + '">Edit</button>' +
                                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' +
                                            row.id + '">Delete</button>';
                                    }
                                }

                            ]
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function deleteStore() {
                $(document).on('click', '.delete-btn', function() {
                    var storeId = $(this).data('id');

                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route('stores.delete') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: storeId
                        },
                        success: function(response) {
                            getData();
                            alert('Store deleted successfully!');
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            }
            deleteStore();
            $('.js-example-basic-single').select2();
        });
    </script>

    </html>
