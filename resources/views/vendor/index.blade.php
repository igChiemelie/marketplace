@extends('layouts.vendor')

@section('content')
<div class="content">
    <!-- Dashboard Tab -->
    <div class="active" id="dashboard">
        <div class="page-title">
            <h1>Vendor Dashboard</h1>
            <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-info">
                    {{-- @foreach ($products as $p)
                        <h3>{{ $p->count() }}</h3>
                    @endforeach --}}
                        
                   <h4>{{$vendor}}</h4>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$order}}</h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <h3>4.8</h3>
                    <p>Average Rating</p>
                </div>
            </div>
            {{-- <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h3>$12,856</h3>
                    <p>Total Revenue</p>
                </div>
            </div> --}}
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Recent Orders</h2>
                <a href="/vendor/orders"><button class="btn btn-primary">View All</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-7256</td>
                                <td>Sarah Johnson</td>
                                <td>Oct 15, 2023</td>
                                <td>$245.99</td>
                                <td><span class="badge badge-primary">Shipped</span></td>
                                {{-- <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                        <a href="/vendor/orders"><button class="btn btn-sm btn-warning edit-order-btn"><i class="fas fa-edit"></i></button></a>
                                        <button class="btn btn-sm btn-danger delete-order-btn"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td> --}}
                            </tr>
                            <tr>
                                <td>#ORD-7255</td>
                                <td>Michael Brown</td>
                                <td>Oct 15, 2023</td>
                                <td>$145.50</td>
                                <td><span class="badge badge-info">Processing</span></td>
                                {{-- <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning edit-order-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger delete-order-btn"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td> --}}
                            </tr>
                            <tr>
                                <td>#ORD-7254</td>
                                <td>Emily Wilson</td>
                                <td>Oct 14, 2023</td>
                                <td>$89.99</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                {{-- <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning edit-order-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger delete-order-btn"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection