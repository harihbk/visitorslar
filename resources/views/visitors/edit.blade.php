@extends('adminlte::page')

@section('content')
    <h1 class="mb-4">Edit Visitor</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for Editing Visitor -->
    <form action="{{ route('visitors.update', $visitor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $visitor->name) }}" >
        </div>

        <!-- Company Field -->
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $visitor->company) }}" >
        </div>

        <!-- Vehicle Number Field -->
        <div class="mb-3">
            <label for="vehicleno" class="form-label">Vehicle No</label>
            <input type="text" class="form-control" id="vehicleno" name="vehicleno" value="{{ old('vehicleno', $visitor->vehicleno) }}" >
        </div>

        <!-- Reference Number Field -->
        <div class="mb-3">
            <label for="refno" class="form-label">Reference No</label>
            <input type="text" class="form-control" id="refno" name="refno" value="{{ old('refno', $visitor->refno) }}" >
        </div>

        <!-- In Time Field -->
        <div class="mb-3">
            <label for="intime" class="form-label">In Time</label>
            <input type="datetime-local" class="form-control" readonly id="intime" name="intime" value="{{ old('intime', \Carbon\Carbon::parse($visitor->intime)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <!-- Out Time Field -->
        <div class="mb-3">
            <label for="outtime" class="form-label">Out Time</label>
            <input type="datetime-local" class="form-control" id="outtime" name="outtime" value="{{ old('outtime', $visitor->outtime ? \Carbon\Carbon::parse($visitor->outtime)->format('Y-m-d\TH:i') : '') }}">
            </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Visitor</button>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
