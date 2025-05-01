@extends('layout')
@section('content')
    <div class="pt-4">
        <div class="page-body row">
            <!-- Container-fluid starts-->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>User</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-wrapper border rounded-3">
                            <form class="row g-3"
                                action="{{ isset($edituser) ? route('user.update', $edituser->id) : route('user') }}"
                                method="POST">
                                @csrf
                                @if (isset($edituser))
                                    @method('PUT')
                                @endif

                                <div class="col-md-12">
                                    <label class="form-label" for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" type="text"
                                        value="{{ old('name', isset($edituser) ? $edituser->name : '') }}"
                                        placeholder="Enter Your Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" type="email"
                                        value="{{ old('email', isset($edituser) ? $edituser->email : '') }}"
                                        placeholder="Enter Your Email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" type="password"
                                        placeholder="{{ isset($edituser) ? 'Leave blank to keep current password' : 'Enter Your Password' }}">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">
                                        {{ isset($edituser) ? 'Update' : 'Submit' }}
                                    </button>
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
                                        <h4> User List</h4>
                                    </div><br/>
                                    <div class="list-product-header">
                                        {{-- <div>
                                            <a class="btn btn-primary" href="add-products.html"><i
                                                    class="fa fa-plus"></i>Add Product</a>
                                        </div> --}}
                                    </div>
                                    <div class="list-product table-responsive">
                                        <table class="table" id="userTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th> <span class="">Name</span></th>
                                                    <th> <span class="">Email</span></th>
                                                    <th> <span class="">Action</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td class="d-flex gap-1">
                                                            <a href="{{ route('user.edit', base64_encode($user->id)) }}">
                                                                {{-- <a href=""> --}}
                                                                <button class="btn btn-sm btn-primary"><i
                                                                        class="fas fa-pencil"></i></button>
                                                            </a>
                                                            <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No User Found</td>
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
            <!-- Container-fluid Ends-->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
                responsive: true,
            });
        });
    </script>
@endsection
