@extends('layouts.app')
@section('content')
<h3>Vendors</h3>
<table class="table">
<thead><tr><th>Shop</th><th>Owner</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
@foreach($vendors as $v)
<tr><td>{{ $v->shop_name }}</td><td>{{ $v->user->email }}</td><td>{{ $v->approval_status }}</td><td>
<form method="POST" action="{{ route('admin.vendors.approve', $v) }}">@csrf @method('PATCH')<button class="btn btn-sm btn-success">Approve</button></form>
</td></tr>
@endforeach
</tbody>
</table>
{{ $vendors->links() }}
@endsection
