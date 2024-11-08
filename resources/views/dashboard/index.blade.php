@extends('adminlte::page')

@section('content')
    <h1 class="mb-4">Dashboard - Visitor List</h1>

    <!-- Filter Form -->
    <form action="{{ route('dashboard.index') }}" method="GET" class="mb-4">
        @csrf
        <div class="row">
            <!-- Intime DateTime Range -->
            <div class="col-md-3">
                <label for="intime_from" class="form-label">In Time</label>
                <input type="date" class="form-control" id="intime_from" name="intime_from" value="{{ request('intime_from') }}">
            </div>

            <div class="col-md-3">
                <label for="intime_to" class="form-label">Out Time</label>
                <input type="date" class="form-control" id="intime_to" name="intime_to" value="{{ request('intime_to') }}">
            </div>

            <div class="col-md-3">
                <label for="reference" class="form-label">Reference no</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{ request('reference') }}">
            </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <form action="{{ route('dashboard.index') }}" method="GET" >
                    @csrf
                    <button type="submit" class="btn btn-danger">Clear</button>
                </form>
               
            </div>
        </div>
    </form>

    <!-- Visitor Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Vehicle No</th>
                <th>Reference No</th>
                <th>In Time</th>
                <th>Out Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->company }}</td>
                    <td>{{ $visitor->vehicleno }}</td>
                    <td>{{ $visitor->refno }}</td>
                    <td>{{ $visitor->intime ? \Carbon\Carbon::parse($visitor->intime)->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td>{{ $visitor->outtime ? \Carbon\Carbon::parse($visitor->outtime)->format('Y-m-d H:i') : 'N/A' }}</td>
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection
