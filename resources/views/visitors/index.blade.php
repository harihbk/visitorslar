

@extends('adminlte::page')



@section('content')

    <h1>Visitor List</h1>

   


    <div class="text-right">
    <a href="{{ route('visitors.create') }}" class="btn btn-primary mb-3 text-right">Add New Visitor</a>

    </div>

    <table id="visitorTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>signature</th>
                <th>Name</th>
                <th>Company</th>
                <th>Vehicle No</th>
                <th>Reference No</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>



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

                    <label for="Signature">Signature</label>

                    <div class="d-flex">
                    <div id="sig" ></div>
                    <input type="hidden" id="signature64" name="signature64">
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


@endsection

@section('js')
    <script>

var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});

$('#clear').click(function(e) {

    e.preventDefault();

    sig.signature('clear');

    $("#signature64").val('');

});

// $.extend($.kbw.signature.options, {color: '#0000ff'});

// var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});

//     $('#clear').click(function(e) {

//         e.preventDefault();

//         sig.signature('clear');

//         $("#signature64").val('');

//     });
   
   $(document).on('click', '.getv', function() {
        $('#visitorId').val($(this).attr("data-id"));
    });

        $(document).ready(function() {


            $('#visitorTable').DataTable({
                
                processing: true,
                serverSide: true,
                ajax: "{{ route('visitors.data') }}",
                columns: [
                    { data: 'file_path', name: 'file_path' , orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'company', name: 'company' },
                    { data: 'vehicleno', name: 'vehicleno' },
                    { data: 'refno', name: 'refno' },
                    { data: 'intime', name: 'intime' },
                    { data: 'outtime', name: 'outtime' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
            });
        });
    </script>
@stop


