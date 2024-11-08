<?php
namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class VisitorController extends Controller
{
    /**
     * Display a listing of the visitors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all visitors from the database
        $visitors = Visitor::all();

        // Return a view with the visitors data (can be passed to a Blade view)
        return view('visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new visitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view with the form to create a new visitor
        return view('visitors.create');
    }

    /**
     * Store a newly created visitor in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'vehicleno' => 'required|string|max:255',
            'refno' => 'required|string|max:255',
            'intime' => 'required|date',
           // 'outtime' => 'required|date',
        ]);

        // echo "<pre>";
        // print_r($request->all());
        // exit();
        // Create a new visitor record in the database
        $intime = $request->input('intime') ? Carbon::parse($request->input('intime')) : null;

        Visitor::create([
            'name' => $request->name,
            'company' => $request->company,
            'vehicleno' => $request->vehicleno,
            'refno' => $request->refno,
            'intime' => $intime
            
        ]);

        // Redirect back to the visitors list or show success message
        return redirect()->route('visitors.index')->with('success', 'Visitor created successfully.');
    }

    /**
     * Display the specified visitor.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        // Show the details of a specific visitor
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified visitor.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        // Show the edit form with the current visitor data
        return view('visitors.edit', compact('visitor'));
    }

    /**
     * Update the specified visitor in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'vehicleno' => 'required|string|max:255',
            'refno' => 'required|string|max:255',
            'intime' => 'required|date',
            'outtime' => 'required|date|after:intime',
        ],[
            'outtime.after' => 'The "Out Time" must be later than the "In Time".',
        ]);

        // Update the visitor record in the database
        $request->outtime = $request->input('outtime') ? Carbon::parse($request->input('outtime')) : null;

     
        $visitor->update($request->all());

        // Redirect to the visitors list with a success message
        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified visitor from the database.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        // Delete the visitor record
        $visitor->delete();

        // Redirect back to the visitors list with a success message
        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }

    public function updateOuttime(Request $request)
        {

            $request->validate([
                'outtime' => 'required|date|after_or_equal:intime',
            ]);

            
            $base64Signature = $request->input('signature64');
            $base64Signature = str_replace('data:image/png;base64,', '', $base64Signature);
            $base64Signature = str_replace(' ', '+', $base64Signature);
            $signatureData = base64_decode($base64Signature);
            $filename = 'signature_' . uniqid() . '.png';
            $path = public_path('signatures/' . $filename);
            File::put($path, $signatureData);


            $visitor = Visitor::find($request->visitor_id);
            $visitor->file_path = 'signatures/' . $filename;
            $visitor->outtime = $request->outtime;
            $visitor->save();

            return redirect()->route('visitors.index')->with('success', 'Out Time updated successfully.');
        }



        public function getVisitorsData()
        {
            $visitors = Visitor::select(['id', 'name', 'company', 'vehicleno', 'refno', 'intime', 'outtime','file_path'])
            ->orderBy('created_at', 'desc'); 

            return Datatables::of($visitors)
            ->addColumn('actions', function ($visitor) {
                $editButton = '<a href="' . route('visitors.edit', $visitor) . '" class="btn btn-sm btn-primary">Edit</a>';
                
                // Conditional button for updating out time
                $updateOuttimeButton = '';
                if ($visitor->outtime == NULL) {
                    $updateOuttimeButton = '<button type="button" class="btn btn-primary btn-sm getv" 
                                            data-toggle="modal" 
                                            data-target="#updateOuttimeModal" 
                                            data-id="' . $visitor->id . '" 
                                            data-outtime="' . $visitor->outtime . '">
                                            Update Out Time
                                        </button>';
                }
                
                // Delete button
                $deleteButton = '<form method="POST" action="' . route('visitors.destroy', $visitor) . '" style="display:inline;">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>';
                
                // Combine buttons into a single return string
                return $editButton . ' ' . $updateOuttimeButton . ' ' . $deleteButton;
            })
                ->editColumn('intime', function ($visitor) {
                    return $visitor->intime ? $visitor->intime->format('Y-m-d H:i') : '';
                })
                ->editColumn('outtime', function ($visitor) {
                    return $visitor->outtime ? $visitor->outtime->format('Y-m-d H:i') : '';
                })
                ->addColumn('file_path', function ($visitor) {
                    if ($visitor->file_path) {
                        return '<img src="' . asset($visitor->file_path) . '" alt="Visitor Image" width="50" height="50" />';
                    }
                    return 'No Image';
                })
                ->rawColumns(['actions','file_path'])
                ->make(true);
        }


}
