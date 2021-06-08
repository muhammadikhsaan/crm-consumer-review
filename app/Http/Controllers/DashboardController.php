<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function showDashboard(Request $request)
    {
        if ($request->get('s')) {
            $date = array(date('Y-m-01', strtotime($request->get('s'))), date('Y-m-31', strtotime($request->get('s'))));
        } else {
            $date = array(date('Y-m-01'), date('Y-m-31'));
        }
        return view('home', [
            'journey' => DB::table('summary_journey')
                            ->rightJoin('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->whereBetween('summary_journey.journey_periode', $date)
                            ->select('summary_journey.id', "journey_list.journey", "journey_list.UIC", "summary_journey.npsn", "summary_journey.npsnn", "summary_journey.ofi", "summary_journey.journey_status", "summary_journey.journey_periode")
                            ->orderBy('summary_journey.journey_id', 'asc')                    
                            ->get(),
        ]);
    }
    
    public function showSummaryOne(Request $request)
    {
        return view('feature.program-dashboard', [
            'program' => DB::table('summary_program')
                            ->leftjoin('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                            ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->where('summary_program.journey_id', '=', $request->get("journey"))
                            ->select('summary_program.id', 'summary_program.program', 'summary_program.ofi', 'journey_list.UIC', 'journey_list.journey', 'summary_program.ofi_priority')
                            ->get(),
            'journey' => DB::table('journey_list')
                            ->join('summary_journey', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->where('summary_journey.id', '=', $request->get("journey"))
                            ->first()
        ]);
    }

    public function showSummaryTwo(Request $request){
        return view('feature.progress-dashboard', [
            'program' => DB::table('summary_program')
                            ->where('id', '=', $request->get('program'))
                            ->first(),
            'progress' => DB::table('summary_progress')
                            ->where('program_id', '=', $request->get('program'))
                            ->get()
        ]);
    }

    public function statusUpdateProgress(Request $request){
        try {
            $stat = DB::table('summary_progress')
                        ->where('id', '=', $request->get('id'))
                        ->update([
                            "progress_status" => strtolower($request->progress_status),
                            "progress_update" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return back();
    }

    public function showProfile(){
        return view("feature.profile", [
            'id' => Auth::id(),
            'user' => User::where('id', '=', Auth::id())->first()
        ]);
    }

    public function updateUser(Request $request)
    {
        $rules = array();
        if (!empty($request->get('password'))) $rules['password'] = 'required|string|min:6|confirmed';

        Validator::make($request->all(), $rules)->validate();

        $data = array();
        if (!empty($request->get('password'))) $data['password'] = bcrypt($request->get('password'));

        User::where('id', '=', Auth::id())->update($data);

        return redirect()->route('dashboard');
    }
}
