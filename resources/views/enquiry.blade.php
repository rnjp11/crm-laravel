@extends('layout')
@section('content')
    <style>
        #enquiryTable {
            font-size: 14px;
            /* Smaller font for tighter layout */
            white-space: nowrap;
            /* Prevents wrapping text */
        }

        #enquiryTable th,
        #enquiryTable td {
            padding: 6px 8px;
            /* Tighter padding */
            vertical-align: middle;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn {
            padding: 4px 6px;
            font-size: 12px;
        }

        .d-flex.gap-1 {
            gap: 4px;
        }

        .enquiry-checkbox {
            height: 15px !important;
        }
    </style>
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
                                        <h4> Enquiry List</h4>
                                        <div>
                                            <button class="btn btn-danger p-2" type="button"
                                                onclick="deleteSelected()">Delete All</button>
                                            <a href="{{ url('/download-enquiries') }}"><button class="btn btn-success p-2"
                                                    type="button">Download</button></a>
                                            <button class="btn btn-primary p-2" type="button" onclick="addEnquiry()">Add
                                                Enquiry</button>
                                        </div>
                                    </div><br />
                                    <div class="list-product table table-responsive">
                                        <table class="table " id="enquiryTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th><input type="checkbox" id="selectAll"
                                                            class="form-check-input checkbox-primary enquiry-checkbox"></th>
                                                    <th> <span class="">Name</span></th>
                                                    <th> <span class="">Email</span></th>
                                                    <th> <span class="">Mobile</span></th>
                                                    <th> <span class="">Service</span></th>
                                                    <th> <span class="">Reference</span></th>
                                                    <th> <span class="">City</span></th>
                                                    <th> <span class="">Type</span></th>
                                                    <th> <span class="">Follow-up date</span></th>
                                                    <th> <span class="">Action</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($enquiries as $enquiry)
                                                    <tr class="product-removes">
                                                        <td><input type="checkbox"
                                                                class="form-check-input checkbox-primary enquiry-checkbox"
                                                                value="{{ $enquiry->id }}"></td>
                                                        <td>{{ $enquiry->name }}</td>
                                                        <td>{{ $enquiry->email }}</td>
                                                        <td>{{ $enquiry->mobile }}</td>
                                                        <td>{{ $enquiry->service_name }}</td>
                                                        <td>{{ $enquiry->reference_name }}</td>
                                                        <td>{{ $enquiry->city_name }}</td>
                                                        <td>{{ $enquiry->type }}</td>
                                                        <td>{{ $enquiry->date }}</td>
                                                        <td class="d-flex gap-1">
                                                            <button class="btn btn-primary"
                                                                onclick="editData({{ $enquiry->id }})">
                                                                <i class="fas fa-pencil"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="deleteData({{ $enquiry->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="openEmailModal('{{ $enquiry->id }}', '{{ $enquiry->email }}','{{ $enquiry->date }}')">
                                                                <i class="fas fa-message"></i>
                                                            </button>
                                                            <button class="btn btn-info"
                                                                onclick="viewmodal({{ $enquiry->id }})">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-dark"
                                                                onclick="openAssignModal('{{ $enquiry->id }}')">
                                                                <i class="fas fa-tasks"></i>
                                                            </button>
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
                                    <h5 class="modal-title" id="enquiryModalLabel">Add Enquiry</h5>
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
                                    <button class="btn btn-secondary p-2" type="button"
                                        data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary p-2" type="button" id="submitEnquiryBtn"
                                        onclick="submitForm()">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Message mail Modal -->
                <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="emailForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Send Email</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="enquirymailId">
                                    <div class="mb-3">
                                        <label for="enquiryemail" class="form-label">Email address <span
                                                class="text-danger">*</span></label>
                                        <input type="enquiryemail" class="form-control" id="enquiryemail"
                                            name="enquiryemail" required>
                                        <div class="invalid-feedback">Valid email is required.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="followupdate" class="form-label">Follow-up Date</label>
                                        <input type="date" class="form-control" id="followupdate" name="followupdate"
                                            rows="4"></input>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Send Mail</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assign Task Modal -->
                <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="assignForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="assignBy" value="{{ $userid }}">
                                    <input type="hidden" id="enquiryassignId">
                                    <div class="col-md-12">
                                        <label class="form-label" for="assignTo">Users</label>
                                        <select class="form-control" id="assignTo" name="assignTo">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Assign Task</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Show enquiry modal --}}
                <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Enquiry Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="viewenquiry" style="overflow-y: auto; height:450px; ">
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

        function addEnquiry() {
            $('#enquiryForm')[0].reset();
            $('#enquiry_id').val('');
            $('#enquiryModalLabel').text('Add Enquiry');
            $('#enquiryModal').modal('show');
        }

        function editData(id) {
            $.ajax({
                url: `{{ url('enquiry') }}/${id}/edit`,
                type: 'GET',
                success: function(data) {
                    $('#enquiryModalLabel').text('Edit Enquiry');
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
            let url = id ? `{{ url('enquiry') }}/${id}` : "{{ route('enquiry.add') }}";
            let type = id ? 'PUT' : 'POST';



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
                    url: `{{ url('enquiry') }}/${id}`,
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
        $(document).ready(function() {
            $('#enquiryTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                ordering: true,
                columnDefs: [{
                    orderable: false,
                    targets: 0 // Disable sorting for the first column (checkbox column)
                }]
            });
        });

        document.getElementById('selectAll').addEventListener('click', function() {
            const checked = this.checked;
            document.querySelectorAll('.enquiry-checkbox').forEach(cb => cb.checked = checked);
        });

        function deleteSelected() {
            let selectedIds = $('.enquiry-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                alert("Please select at least one entry.");
                return;
            }

            if (!confirm("Are you sure you want to delete selected enquiries?")) return;

            $.ajax({
                url: "{{ route('enquiry.bulkDelete') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert("Something went wrong.");
                    }
                },
                error: function() {
                    alert("An error occurred while deleting.");
                }
            });
        }

        function openEmailModal(id, email, followupdate) {
            $('#enquirymailId').val(id);
            $('#enquiryemail').val(email);
            $('#followupdate').val(followupdate);
            $('#message').val('');

            if (email) {
                $('#enquiryemail').prop('disabled', true);
            } else {
                $('#enquiryemail').prop('disabled', false);
            }

            $('#emailModal').modal('show');
        }

        function openAssignModal(id) {
            $('#enquiryassignId').val(id);
            $('#assignModal').modal('show');
        }

        function viewmodal(id) {
            $.ajax({
                type: 'post',
                url: "{{ url('view-enquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#viewenquiry').html(data);
                    $('#viewmodal').modal('show');

                },
                error: function(e) {
                    alert(e.responseText);
                }
            })
        }
        $('#emailForm').on('submit', function(e) {
            e.preventDefault();

            let enquiryId = $('#enquirymailId').val();
            let email = $('#enquiryemail').val();
            let followupdate = $('#followupdate').val();
            let message = $('#message').val();

            if (!email) {
                $('#enquiryemail').addClass('is-invalid');
                return;
            } else {
                $('#enquiryemail').removeClass('is-invalid');
            }

            if (!message) {
                alert('Please enter a message');
                $('#message').addClass('is-invalid');
                return;
            } else {
                $('#message').removeClass('is-invalid');
            }

            $.ajax({
                url: `{{ url('send-enquiry-email') }}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: enquiryId,
                    email: email,
                    followupdate: followupdate,
                    message: message,
                },
                success: function(response) {
                    alert(response.message);
                    $('#emailModal').modal('hide');
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        alert("Error: " + xhr.responseJSON.message);
                    } else {
                        alert("An unknown error occurred.");
                    }
                }
            });
        });

        $('#assignForm').on('submit', function(e) {
            e.preventDefault();

            let assignBy = $('#assignBy').val();
            let assignTo = $('#assignTo').val();
            let enquiryassignId = $('#enquiryassignId').val();

            $.ajax({
                url: `{{ url('assign-enquiry') }}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: enquiryassignId,
                    assignBy: assignBy,
                    assignTo: assignTo
                },
                success: function(response) {
                    alert(response.message);
                    $('#assignModal').modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        alert("Error: " + xhr.responseJSON.message);
                    } else {
                        alert("An unknown error occurred.");
                    }
                }
            });
        });
    </script>
@endsection
