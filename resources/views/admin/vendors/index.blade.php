@extends('layouts.admin')

@section('content')

<!-- Users Tab -->
<div id="users">
    <div class="page-title">
        <h1>User Management</h1>
    
        <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">All Users</h2>
            <div class="action-buttons">
                <button class="btn btn-sm btn-primary"><i class="fas fa-file-export"></i> Export</button>
                <button class="btn btn-sm btn-success"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
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
                        @forelse ($vendors as $v)
                            <tr>
                                <td>#{{ $v->id }}</td>
                                <td>{{ $v->shop_name }}</td>
                                <td>{{ $v->user->name }}</td>
                                <td>{{ $v->user->email }}</td>
                                <td>{{ ucfirst($v->user->role) }}</td>
                                <td>
                                    @if ($v->approval_status === 'approved')
                                        <span class="badge bg-success">{{ $v->approval_status }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $v->approval_status }}</span>
                                    @endif
                                </td>
                                <td>{{ $v->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-buttons gap-2">
                                        @if ($v->approval_status !== 'approved')
                                            <form method="POST" action="{{ route('admin.vendors.approve', $v) }}">
                                                @csrf 
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.vendors.reject', $v) }}">
                                                @csrf 
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fas fa-check"></i> Reject
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-info" disabled>
                                                <i class="fas fa-check"></i> Approved
                                            </button>
                                        @endif

                                        <form method="POST" action="{{ route('admin.vendors.destroy', $v) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->

                <div class="pagination-wrapper">
                    {{ $vendors->links('vendor-pagination') }}
                </div>
            </div>

        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error'
            });
        </script>
    @endif

    @if (session('success'))

        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

@endsection
