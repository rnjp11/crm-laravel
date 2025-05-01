@extends('layout')
@section('content')
    <div class="pt-4">
        <div class="page-body row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>City</h4>
                    </div>
                    <div class="card-body">

                        <div class="card-wrapper border rounded-3">
                            <form class="row g-3" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <input type="hidden" id="city_id" name="city_id" value="">
                                    <label class="form-label" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                        placeholder="Enter Name">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="button" onclick="submitForm()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h4> City List</h4>
                                    </div><br />
                                    <div class="list-product-header">
                                        {{-- <div>
                                            <a class="btn btn-primary" href="add-products.html"></i>Download</a>
                                        </div> --}}
                                    </div>
                                    <div class="list-product">
                                        <table class="table" id="cityTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($cities as $city)
                                                    <tr>
                                                        <td>{{ $city->name }}</td>
                                                        <td>{{ $city->status }}</td>
                                                        <td class="d-flex gap-1">
                                                            <button class="btn btn-primary"
                                                                onclick="editData({{ $city->id }})">
                                                                <i class="fas fa-pencil"></i>
                                                            </button>
                                                            <button class="btn btn-danger"
                                                                onclick="deleteData({{ $city->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No Data Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        function submitForm() {
            const id = $('#city_id').val();
            const url = id ? `{{ url('city') }}/${id}` : "{{ route('city.add') }}";
            const type = id ? 'PUT' : 'POST';

            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                url: url,
                type: type,
                data: {
                    name: $('#name').val(),
                    status: $('#status').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    alert(id ? 'City updated!' : 'City inserted!');
                    location.reload();
                },
                error: function(err) {
                    if (err.status === 422) {
                        const errors = err.responseJSON.errors;
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                            $('#name').after(`<small class="text-danger">${errors.name[0]}</small>`);
                        }
                        if (errors.status) {
                            $('#status').addClass('is-invalid');
                            $('#status').after(`<small class="text-danger">${errors.status[0]}</small>`);
                        }
                    } else {
                        alert('Something went wrong');
                    }
                }
            });
        }

        function editData(id) {
            $.ajax({
                url: `{{ url('city') }}/${id}/edit`,
                type: 'GET',
                success: function(data) {
                    $('#city_id').val(data.id);
                    $('#name').val(data.name);
                    $('#status').val(data.status);
                }
            });
        }

        function deleteData(id) {
            if (confirm('Are you sure to delete this city?')) {
                $.ajax({
                    url: `{{ url('city') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        // alert('Reference deleted!');
                        location.reload();
                    }
                });
            }
        }
        $(document).ready(function() {
            $('#cityTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
                responsive: true,
            });
        });
        // $(document).ready(function() {
        //     $('#search').on('input', function() {
        //         let query = $(this).val();
        //         fetchData(1, query);
        //     });

        //     $(document).on('click', '.pagination a', function(e) {
        //         e.preventDefault();
        //         let page = $(this).attr('href').split('page=')[1];
        //         let query = $('#search').val();
        //         fetchData(page, query);
        //     });

        //     function fetchData(page = 1, query = '') {
        //         $.ajax({
        //             url: "{{ route('city.index') }}" + `?page=${page}&search=${query}`,
        //             success: function(res) {
        //                 $('#city-table').html(res.html);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(xhr.responseText); // for debugging
        //                 alert('Error loading data');
        //             }
        //         });
        //     }
        // });
    </script>
@endsection
