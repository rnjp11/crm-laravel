@extends('layout')
@section('content')
    <style>

    </style>
    <div class="pt-4">
        <div class="page-body row">
            <input type="hidden" id="user_id" name="user_id" value="{{ $userid }}">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4> {{ $status }} Enquiries List</h4>
                                    </div><br />
                                    <div class="list-product table table-responsive">
                                        <table class="table " id="enquiryTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th> <span>Name</span></th>
                                                    <th> <span>Email</span></th>
                                                    <th> <span>Mobile</span></th>
                                                    <th> <span>Service</span></th>
                                                    <th> <span>Reference</span></th>
                                                    <th> <span>City</span></th>
                                                    <th> <span>Follow-up date</span></th>
                                                    @if ($status == 'Converted' || $status == 'Cancelled')
                                                        <th><span>Updated by</span></th>
                                                    @endif
                                                    @if ($status == 'Cancelled')
                                                        <th><span>Reason</span></th>
                                                    @endif
                                                    @if ($status == 'Assigned')
                                                        <th><span>Assigned To</span></th>
                                                        <th><span>Assigned By</span></th>
                                                    @endif
                                                    <th> <span>Action</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($enquiries as $enquiry)
                                                    <tr class="product-removes">
                                                        <td>{{ $enquiry->name }}</td>
                                                        <td>{{ $enquiry->email }}</td>
                                                        <td>{{ $enquiry->mobile }}</td>
                                                        <td>{{ $enquiry->service_name }}</td>
                                                        <td>{{ $enquiry->reference_name }}</td>
                                                        <td>{{ $enquiry->city_name }}</td>
                                                        <td>{{ $enquiry->date }}</td>
                                                        @if ($status == 'Converted' || $status == 'Cancelled')
                                                            <td><span>{{ $enquiry->user_name }}</span></td>
                                                        @endif
                                                        @if ($status == 'Cancelled')
                                                            <td><span>{{ $enquiry->reason }}</span></td>
                                                        @endif
                                                        @if ($status == 'Assigned')
                                                            <td><span>{{ $enquiry->assigned_to_name }}</span></td>
                                                            <td><span>{{ $enquiry->assigned_by_name }}</span></td>
                                                        @endif
                                                        <td class="d-flex gap-1">
                                                            <button class="btn btn-primary"
                                                                onclick="editData({{ $enquiry->id }})"
                                                                {{ $iseditable ? '' : 'disabled' }}>
                                                                <i class="fas fa-pencil"></i>
                                                            </button>
                                                            {{-- <button type="submit" class="btn btn-danger"
                                                                onclick="deleteData({{ $enquiry->id }})"
                                                                {{ $iseditable ? '' : 'disabled' }}>
                                                                <i class="fas fa-trash"></i>
                                                            </button> --}}
                                                            @if (in_array($status, ['Hot', 'Warm', 'Cold']))
                                                                <button class="btn btn-success"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Converted')">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Cancelled', '{{ $enquiry->name }}')">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            @endif
                                                            {{-- <button class="btn btn-info"
                                                                onclick="viewmodal({{ $enquiry->id }})">
                                                                <i class="fas fa-eye"></i>
                                                            </button> --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Data Found</td>
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

                <!-- Enquiry Modal -->
                <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="enquiryForm" method="POST">
                                @csrf
                                <input type="hidden" id="enquiry_id" name="enquiry_id">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="enquiryModalLabel">Update Enquiry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email"
                                            placeholder="Enter Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="mobile">Mobile</label>
                                        <input class="form-control" id="mobile" name="mobile" type="text"
                                            placeholder="Enter Mobile">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="service">Service</label>
                                        <select class="form-control" id="service" name="service">
                                            <option value="">Select Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="reference">Reference</label>
                                        <select class="form-control" id="reference" name="reference">
                                            <option value="">Select Reference</option>
                                            @foreach ($references as $ref)
                                                <option value="{{ $ref->id }}">{{ $ref->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="city">City</label>
                                        <select class="form-control" id="city" name="city">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="type">Type</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="Hot">Hot</option>
                                            <option value="Warm">Warm</option>
                                            <option value="Cold">Cold</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label" for="date">Follow-up Date</label>
                                        <input class="form-control" id="date" name="date" type="date">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="button" id="submitEnquiryBtn"
                                        onclick="submitForm()">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Cancel Modal -->
                <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cancel Enquiry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="cancelEnquiryId">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="cancelEnquiryName" disabled>
                                </div>
                                <div class="mb-3">
                                    <label>Reason</label>
                                    <textarea id="cancelReason" class="form-control" placeholder="Enter reason for cancellation"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-danger" onclick="submitCancelForm()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Show enquiry modal --}}
                <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Enquiry Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <table>

                            </table>
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

        function editData(id) {
            $.ajax({
                url: `{{ url('enquiry-show') }}/${id}/edit`,
                type: 'GET',
                success: function(data) {
                    $('#enquiry_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#mobile').val(data.mobile);
                    $('#service').val(data.service);
                    $('#reference').val(data.reference);
                    $('#city').val(data.city);
                    $('#date').val(data.date);

                    $('#enquiryModal').modal('show');
                }
            });
        }

        function submitForm() {
            let id = $('#enquiry_id').val();
            let url = `{{ url('enquiry-show') }}/${id}`;
            let type = 'PUT';

            let data = {
                'user_id': $('#user_id').val(),
                'name': $('#name').val(),
                'email': $('#email').val(),
                'mobile': $('#mobile').val(),
                'service': $('#service').val(),
                'reference': $('#reference').val(),
                'city': $('#city').val(),
                'type': $('#type').val(),
                'date': $('#date').val(),
                '_token': '{{ csrf_token() }}'
            }

            $.ajax({
                url: url,
                type: type,
                data: data,
                success: function(res) {
                    if (res.status == 1) {
                        $('#enquiryModal').modal('hide');
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(err) {
                    if (err.status === 422) {
                        const errors = err.responseJSON.errors;

                        // Clear previous errors
                        $('.text-danger').remove();
                        $('.is-invalid').removeClass('is-invalid');

                        $.each(errors, function(field, messages) {
                            const input = $(`#${field}`);
                            input.addClass('is-invalid');
                            input.after(`<small class="text-danger">${messages[0]}</small>`);
                        });
                    } else {
                        alert('Something went wrong');
                    }
                }

            });
            return false;
        }

        function deleteData(id) {
            if (confirm('Are you sure to delete this enquiry?')) {
                $.ajax({
                    url: `{{ url('enquiry-show') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    }
                });
            }
        }

        function updateStatus(id, status, name = '') {
            if (status === 'Cancelled') {
                $('#cancelEnquiryId').val(id);
                $('#cancelEnquiryName').val(name);
                $('#cancelModal').modal('show');
            } else {
                var data = {
                    id: id,
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };
                $.ajax({
                    url: '{{ route('enquiry.updateStatus') }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        }

        function submitCancelForm() {
            var id = $('#cancelEnquiryId').val();
            var reason = $('#cancelReason').val();
            var data = {
                id: id,
                status: 'Cancelled',
                reason: reason,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
            $.ajax({
                url: '{{ route('enquiry.updateStatus') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#cancelModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Failed to cancel enquiry');
                    }
                }
            });
        }

        function viewmodal(id) {
            $.ajax({
                type: 'post',
                url: `url('view-enquiry')`,
                data: {
                    id: id
                },
                success: function(data) {
                    enquirydata = `<tr>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>${data.email}</td>
                        <td>${data.mobile}</td>
                        <td>${data.service}</td>
                        <td>${data.reference}</td>
                        <td>${data.city}</td>
                        <td>${data.date}</td>
                        <td>${data.type}</td>
                     </tr>`;
                    $('#viewenquiry').html(enquirydata);
                },
                error: function(e) {
                    alert(e.responseText);
                }
            })
        }
        $(document).ready(function() {
            $('#enquiryTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
            });
        });
    </script>
@endsection
