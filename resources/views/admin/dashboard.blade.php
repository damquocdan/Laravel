@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Trang Quản Trị</h1>

    <h2>Bảng Thống Kê</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mặt Hàng</th>
                <th>Số Lượng</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sản Phẩm</td>
                <td>{{ $productCount }}</td>
            </tr>
            <tr>
                <td>Danh Mục</td>
                <td>{{ $categoryCount }}</td>
            </tr>
            <tr>
                <td>Người Dùng</td>
                <td>{{ $userCount }}</td>
            </tr>
            <tr>
                <td>Đơn Hàng</td>
                <td>{{ $orderCount }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Biểu Đồ Thống Kê</h2>
    <div class="chart-container">
        <canvas id="statsChart"></canvas>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Get the counts from the backend
        const productCount = {{ $productCount }};
        const categoryCount = {{ $categoryCount }};
        const userCount = {{ $userCount }};
        const orderCount = {{ $orderCount }};

        // Create the chart
        const ctx = document.getElementById('statsChart').getContext('2d');
        const statsChart = new Chart(ctx, {
            type: 'bar', // Type of chart: bar, line, pie, etc.
            data: {
                labels: ['Sản Phẩm', 'Danh Mục', 'Người Dùng', 'Đơn Hàng'], // X-axis labels in Vietnamese
                datasets: [{
                    label: 'Số Lượng',
                    data: [productCount, categoryCount, userCount, orderCount], // Data values from PHP
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)', // Color for Products
                        'rgba(54, 162, 235, 0.5)', // Color for Categories
                        'rgba(255, 206, 86, 0.5)', // Color for Users
                        'rgba(153, 102, 255, 0.5)', // Color for Orders
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', 
                        'rgba(54, 162, 235, 1)', 
                        'rgba(255, 206, 86, 1)', 
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số Lượng'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Loại Hàng'
                        }
                    }
                }
            }
        });
    </script>

    <style>
        .table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* Collapse borders */
        margin-bottom: 20px; /* Space below the table */
        background-color: #f9f9f9; /* Light background */
    }

    .table th, .table td {
        padding: 12px; /* Padding for table cells */
        text-align: left; /* Align text to the left */
        border-bottom: 1px solid #dee2e6; /* Bottom border for rows */
    }

    .table th {
        background-color: #343a40; /* Darker background for header */
        color: #ffffff; /* White text color */
        font-weight: bold; /* Bold text */
    }

    .table tbody tr:hover {
        background-color: #e9ecef; /* Light gray background on row hover */
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray for even rows */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #ffffff; /* White for odd rows */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table {
            display: block; /* Stack table on small screens */
            overflow-x: auto; /* Horizontal scroll */
        }
    }
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px; /* Adjust height as needed */
            margin-top: 20px;
        }

        .table {
            margin-bottom: 30px;
        }

        th {
            background-color: #f8f9fa; /* Light gray for header */
            color: #212529; /* Dark text */
        }

        tr:hover {
            background-color: #e9ecef; /* Light gray on hover */
        }

        h1, h2 {
            margin-top: 20px;
            color: #343a40; /* Darker text color */
        }
    </style>
</div>
@endsection
