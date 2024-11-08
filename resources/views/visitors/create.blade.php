<!-- resources/views/visitors/create.blade.php -->

@extends('adminlte::page')



@section('content')
    <h1 class="mb-4">Add New Visitor</h1>

    <!-- Form -->
    <form action="{{ route('visitors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}">
            @error('company')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="vehicleno" class="form-label">Vehicle No</label>
            <input type="text" class="form-control @error('vehicleno') is-invalid @enderror" id="vehicleno" name="vehicleno" value="{{ old('vehicleno') }}">
            @error('vehicleno')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="refno" class="form-label">Reference No</label>
            <input type="text" class="form-control @error('refno') is-invalid @enderror" id="refno" name="refno" value="{{ old('refno') }}">
            @error('refno')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="intime" class="form-label">In Time</label>
            <input type="datetime-local" class="form-control @error('intime') is-invalid @enderror" id="intime" name="intime" value="{{ old('intime') ? \Carbon\Carbon::parse(old('intime'))->format('Y-m-d\TH:i') : '' }}">
            @error('intime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- <div class="mb-3">
            <label for="outtime" class="form-label">Out Time</label>
            <input type="datetime-local" class="form-control @error('outtime') is-invalid @enderror" id="outtime" name="outtime">
            @error('outtime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
