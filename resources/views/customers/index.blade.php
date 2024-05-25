<!DOCTYPE html>
<html>
<head>
    <title>Laravel Excel CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Customers List</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('customers.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Import Excel File:</label>
            <input type="file" name="file" class="form-control" accept=".xls,.xlsx" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('customers.export') }}" class="btn btn-success mt-3">Export to Excel</a>
</div>
</body>
</html>
