<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Initialize query builder for visitors
        $query = Visitor::query();
      

      
        if ($request->intime_from) {
            $intimeStart = Carbon::parse($request->input('intime_from'))->toDateString();
            $query->whereDate('intime', '>=', $intimeStart);
        }
    
        if ($request->intime_to) {
            $intimeEnd = Carbon::parse($request->input('intime_to'))->toDateString();
            $query->whereDate('outtime', '<=', $intimeEnd);
        }


        if ($request->reference) {
            $query->where('refno', '=', $request->input('reference'));
        }


        // Fetch the filtered results
        $visitors = $query->orderBy('created_at', 'desc')->get();

     

        // Return the view with filtered visitors
        return view('dashboard.index', compact('visitors'));
    }
}
