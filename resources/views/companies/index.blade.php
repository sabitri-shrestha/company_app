@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="text-align: center;">Companies</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Create New</a>
        </div>
        <div class="row justify-content-center">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $key=>$company)
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            <img src="{{ asset($company->logo) }}" alt="{{ $company->name }} Logo" width="50" height="50">
                        </td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline-block">
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
                {{ $companies->links() }}
            </div>
        </div>
    </div>
@endsection
