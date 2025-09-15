@extends('layouts.admin')
@section('content')
<!-- Users Tab -->
<div class="" id="users">
    <div class="page-title">
        <h1>User Management</h1>
        <button class="btn btn-primary"><i class="fas fa-plus"></i> Add User</button>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>All Users</h2>
            <div class="action-buttons">
                <button class="btn btn-sm btn-primary">Export</button>
                <button class="btn btn-sm btn-success">Filter</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Shop</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $v)
                            
                        @endforeach
                        <tr>
                            <td>#USR-001</td>
                            <td>{{ $v->shop_name }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->role }}</td>
                            @if ($v->approval_status == 'approved')
                                <td><span class="badge badge-success">{{ $v->approval_status }}</span></td>
                            @else
                                <td><span class="badge badge-warning">{{ $v->approval_status }}</span></td>
                            @endif
                            <td>{{$v->created_at}}</td>
                            <td>
                                <div class="action-buttons">
                                    {{-- <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button> --}}
                                    @if ($v->approval_status !== 'approved')
                                        <form method="POST" action="{{ route('admin.vendors.approve', $v) }}">@csrf @method('PATCH')
                                            <button class="btn btn-sm btn-success"><i class="fas fa-edit"></i>Approve</button>
                                        </form>
                                    @endif
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#USR-002</td>
                            <td>Sarah Johnson</td>
                            <td>sarah@example.com</td>
                            <td>Moderator</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>Feb 28, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#USR-003</td>
                            <td>Michael Brown</td>
                            <td>michael@example.com</td>
                            <td>Customer</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>Mar 15, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#USR-004</td>
                            <td>Emily Wilson</td>
                            <td>emily@example.com</td>
                            <td>Vendor</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>Apr 3, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#USR-005</td>
                            <td>David Miller</td>
                            <td>david@example.com</td>
                            <td>Customer</td>
                            <td><span class="badge badge-danger">Suspended</span></td>
                            <td>May 19, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection