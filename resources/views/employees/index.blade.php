@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="text-align: center;">Employees</h2>
        <div class="row justify-content-center">
            <div class="mb-3">
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create New</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
