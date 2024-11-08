<!-- 
@extends('adminlte::page')


@section('content')
    <h1 class="mb-4">Visitor List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('visitors.create') }}" class="btn btn-primary mb-3">Add New Visitor</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Vehicle No</th>
                <th>Reference No</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr >
                    <td> 
   
                    
                    <a href="{{ route('visitors.edit', $visitor) }}">{{ $visitor->name }}</a> </td>
                    <td><a href="{{ route('visitors.edit', $visitor) }}">{{ $visitor->company }}</a> </td>
                    <td>{{ $visitor->vehicleno }}</td>
                    <td>{{ $visitor->refno }}</td>
                    <td>{{ $visitor->intime ? \Carbon\Carbon::parse($visitor->intime)->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td>{{ $visitor->outtime ? \Carbon\Carbon::parse($visitor->outtime)->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning btn-sm">Edit</a>
                        @if($visitor->outtime == NULL)
                        <button type="button" class="btn btn-primary btn-sm getv" 
            data-toggle="modal" 
            data-target="#updateOuttimeModal" 
            data-id="{{ $visitor->id }}" 
            data-outtime="{{ $visitor->outtime }}" >
        Update Out Time
    </button>   
 
                        @endif
                        <form action="{{ route('visitors.destroy', $visitor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection





<div class="modal fade" id="updateOuttimeModal" tabindex="-1" aria-labelledby="updateOuttimeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
       
            <form id="updateOuttimeForm" action="{{ route('visitors.updateOuttime') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="visitor_id" id="visitorId">
                
              
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="outtime" class="form-label">Out Time</label>
                        <input type="datetime-local" class="form-control" id="outtime" name="outtime" required>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('js')
    <script> 
    $('.getv').on('click', function() {
        $('#visitorId').val($(this).attr("data-id"));
     
});

            



    </script>
@stop -->