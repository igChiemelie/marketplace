@extends('layouts.admin')
@section('content')
<!-- Analytics Tab -->
<div class="" id="analytics">
    <div class="page-title">
        <h1>Analytics & Reports</h1>
        <button class="btn btn-primary"><i class="fas fa-download"></i> Export Report</button>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <h3>+24.5%</h3>
                <p>Sales Growth</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <div class="stat-info">
                <h3>1,258</h3>
                <p>This Month Orders</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>+345</h3>
                <p>New Customers</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-info">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <h3>$89,526</h3>
                <p>Revenue This Month</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Sales Performance</h2>
            <div class="action-buttons">
                <button class="btn btn-sm btn-primary">Last 7 Days</button>
                <button class="btn btn-sm btn-success">Last 30 Days</button>
            </div>
        </div>
        <div class="card-body">
            <div
                style="height: 300px; background-color: var(--light); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; color: var(--gray);">
                Sales Chart Visualization Area
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Top Selling Products</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Units Sold</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Wireless Headphones</td>
                            <td>Electronics</td>
                            <td>$149.99</td>
                            <td>267</td>
                            <td>$40,053.33</td>
                        </tr>
                        <tr>
                            <td>Smartphone X Pro</td>
                            <td>Electronics</td>
                            <td>$899.99</td>
                            <td>142</td>
                            <td>$127,798.58</td>
                        </tr>
                        <tr>
                            <td>Premium Gaming Laptop</td>
                            <td>Electronics</td>
                            <td>$1,299.99</td>
                            <td>84</td>
                            <td>$109,199.16</td>
                        </tr>
                        <tr>
                            <td>Ultra Slim Tablet</td>
                            <td>Electronics</td>
                            <td>$499.99</td>
                            <td>118</td>
                            <td>$58,998.82</td>
                        </tr>
                        <tr>
                            <td>Mechanical Keyboard</td>
                            <td>Accessories</td>
                            <td>$89.99</td>
                            <td>205</td>
                            <td>$18,447.95</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection