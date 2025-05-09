@extends('layout')

@section('content')
    <style>
        .stylish-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(100, 98, 242, 0.3);
        }

        .stylish-card {
            border-radius: 16px;
            color: white;
            background: linear-gradient(135deg, #6462f2, #8785f5);
            /* fallback */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: white;
        }

        .stylish-card.cancelled {
            background: linear-gradient(135deg, #e7205a, #faa3a6);
        }

        .stylish-card.warm {
            background: linear-gradient(135deg, #f29768, #f9c39f);
        }

        .stylish-card.cold {
            background: linear-gradient(135deg, #6462f2, #bdbcf7);
        }

        .stylish-card.converted {
            background: linear-gradient(135deg, #61AE41, #aac399);
        }

        .stylish-card.hot {
            background: linear-gradient(135deg, #b24592, #fcafbc);
        }

        .stylish-card.assigned {
            background: linear-gradient(135deg, #0798e5, #9dc5da);
        }
        /* Optional: make text readable on light backgrounds */
        .stylish-card h4,
        .stylish-card h5 {
            color: #fff;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 p-0">
                        <h3>
                            CRM Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid ecommerce-dashboard">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 box-col-12">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="card total-sales stylish-card hot">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <a href="{{ url('enquiry-show?status=Hot') }}" class=" align-items-center">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-fire"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Hot Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $hotLeads }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="card total-sales stylish-card warm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <a href="{{ url('enquiry-show?status=Warm') }}" class=" align-items-center">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-thermometer-half"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Warm Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $warmLeads }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card total-sales stylish-card cold">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <a href="{{ url('enquiry-show?status=Cold') }}" class=" align-items-center">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-cube"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Cold Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $coldLeads }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card total-sales stylish-card converted">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <a href="{{ url('enquiry-show?status=Converted') }}"
                                                class=" align-items-center">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Converted Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $convertedLeads }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card total-sales stylish-card cancelled">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <a href="{{ url('enquiry-show?status=Cancelled') }}" class=" align-items-center">
                                            <div class="col-12">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-times-circle"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Cancelled Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $cancelledLeads }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card total-sales stylish-card assigned">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <a href="{{ url('enquiry-show?status=Assigned') }}" class=" align-items-center">
                                            <div class="col-12">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="icon-circle"
                                                        style="display: flex; justify-content: center;">
                                                        <i class="fas fa-tasks"></i>
                                                    </div>
                                                    <div class="dcard">
                                                        <h4 class="mb-1">Assign Lead</h4>
                                                        <h5 class="text-muted fw-semibold">{{ $assignedLeads }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 box-col-6e">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4> Today's Enquiries</h4><br /><br />

                                        </div>
                                        <div class="list-product table table-responsive">
                                            <table class="table " id="todayEnquiryTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th> <span class=" f-w-700">Name</span></th>
                                                        {{-- <th> <span class=" f-w-700">Email</span></th> --}}
                                                        <th> <span class=" f-w-700">Mobile</span></th>
                                                        <th> <span class=" f-w-700">Follow-up date</span></th>
                                                        <th> <span class=" f-w-700">Action</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($todayEnquiry as $enquiry)
                                                        <tr class="product-removes">
                                                            <td>{{ $enquiry->name }}</td>
                                                            {{-- <td>{{ $enquiry->email }}</td> --}}
                                                            <td>{{ $enquiry->mobile }}</td>
                                                            <td>{{ $enquiry->date }}</td>
                                                            <td class="d-flex gap-1">
                                                                <button class="btn btn-primary"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Converted')">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Cancelled', '{{ $enquiry->name }}')">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                <button class="btn btn-warning"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Pending')">
                                                                    <i class="fas fa-hourglass-half"></i>
                                                                </button>
                                                                <button class="btn btn-info"
                                                                onclick="viewmodal({{ $enquiry->id }})">
                                                                <i class="fas fa-eye"></i>
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

                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 box-col-6e">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4> Monthly Pending Enquiries</h4><br /><br />

                                        </div>
                                        <div class="list-product table table-responsive">
                                            <table class="table " id="monthEnquiryTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th> <span class=" f-w-700">Name</span></th>
                                                        {{-- <th> <span class=" f-w-700">Email</span></th> --}}
                                                        <th> <span class=" f-w-700">Mobile</span></th>
                                                        <th> <span class=" f-w-700">Follow-up date</span></th>
                                                        <th> <span class=" f-w-700">Action</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($monthEnquiry as $enquiry)
                                                        <tr class="product-removes">
                                                            <td>{{ $enquiry->name }}</td>
                                                            {{-- <td>{{ $enquiry->email }}</td> --}}
                                                            <td>{{ $enquiry->mobile }}</td>
                                                            <td>{{ $enquiry->date }}</td>
                                                            <td class="d-flex gap-1">
                                                                <button class="btn btn-primary"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Converted')">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="updateStatus({{ $enquiry->id }}, 'Cancelled', '{{ $enquiry->name }}')">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                <button class="btn btn-info"
                                                                onclick="viewmodal({{ $enquiry->id }})">
                                                                <i class="fas fa-eye"></i>
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
            <!-- Message Modal -->
            <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="messageModalTitle">
                                Folloup Messages
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Follow Up Date</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody id="messageTableBody">

                                </tbody>
                            </table>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="viewenquiry" style="overflow-y: auto; height:450px; ">
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- Container-fluid Ends-->
    </div>
    <script>
        $(document).ready(function() {
            $('#todayEnquiryTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
            });
        });
        $(document).ready(function() {
            $('#monthEnquiryTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

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
       
        $(document).on('click', '.messageBtn', function() {
            let enquiryId = $(this).data('id');
            $.ajax({
                url: `{{ url('messages') }}/${enquiryId}`,
                type: 'GET',
                success: function(data) {
                    let messageTableBody = '';

                    if (data.length > 0) {
                        data.forEach(function(message) {
                            messageTableBody += `
                            <tr>
                                <td>${message.followup_date || ''}</td>
                                <td>${message.message || ''}</td>
                            </tr>
                            `;
                        });
                    } else {
                        messageTableBody = `
                        <tr>
                            <td colspan="2" class="text-center">No messages found.</td>
                        </tr>
                        `;
                    }

                    $('#messageModal tbody').html(messageTableBody);
                    $('#messageModal').modal('show');
                },
                error: function(e) {
                    console.log(e);
                    alert('Failed to load enquiry messages.');
                }
            });
        });
    </script>
@endsection
