<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    // ------------------------ SUMMARY JOURNEY HANDLE ------------------------ //
    // ------------------------ SUMMARY JOURNEY HANDLE ------------------------ //
    // ------------------------ SUMMARY JOURNEY HANDLE ------------------------ //


    public function showAddJouney(){
        return view('feature.journey.add', [
            'journey' => DB::table('journey_list')->get()
        ]);
    }

    public function storeAddJouney(Request $request){
        try {
            $stat = DB::table('summary_journey')
                        ->insert([
                            "journey_id" => $request->get('journey_id'),
                            "npsn" => $request->get('npsn'),
                            "npsnn" => $request->get('npsnn'),
                            "ofi" => $request->get('ofi'),
                            "journey_periode" => $request->get('journey_periode'),
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return $request->get("action") == "new" ? back() : redirect()->route('dashboard');
    }

    public function updateJouney(Request $request){
        return view('feature.journey.update', [
            'journey' => DB::table('journey_list')->get(),
            'value' => DB::table('summary_journey')
                            ->where('id' , '=', $request->get('id'))
                            ->first()
        ]);
    }

    public function storeUpdateJouney(Request $request){
        try {
            $stat = DB::table('summary_journey')
                        ->where('id', $request->get('id'))
                        ->update([
                            "journey_id" => $request->get('journey_id'),
                            "npsn" => $request->get('npsn'),
                            "npsnn" => $request->get('npsnn'),
                            "ofi" => $request->get('ofi'),
                            "journey_periode" => $request->get('journey_periode'),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);            
        } catch (\Throwable $th) {
            return redirect()->route('dashboard');
        }
        
        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard');
    }

    public function deleteJouney(Request $request, $id){
        $stat = DB::table('summary_journey')
                    ->where('id', $id)
                    ->delete();

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard');
    }

    // ------------------------ SUMMARY PROGRAM HANDLE ------------------------ //
    // ------------------------ SUMMARY PROGRAM HANDLE ------------------------ //
    // ------------------------ SUMMARY PROGRAM HANDLE ------------------------ //

    public function showAddProgram(Request $request){
        return view('feature.program.add');
    }
    
    public function storeAddProgram(Request $request){
        try {
            $stat = DB::table('summary_program')
                        ->insert([
                            "journey_id" => $request->get("journey"),
                            "program" => $request->get("program"),
                            "ofi" => $request->get("ofi"),
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);
        
        return $request->get("action") == "new" ? back() : redirect()->route('dashboard.program', ["journey" => $request->get("journey")]);
    }

    public function updateProgram(Request $request){
        return view('feature.program.update', [
            'value' => DB::table('summary_program')
                            ->where('id' , '=', $request->get('id'))
                            ->first()
        ]);
    }

    public function updateProgress(Request $request){
        return view('feature.progress.update', [
            'value' => DB::table('summary_progress')
                            ->where('id', '=', $request->get('id'))
                            ->first()
        ]);
    }

    public function storeUpdateProgram(Request $request){
        try {
            $stat = DB::table('summary_program')
                        ->where('id', '=', $request->get('id'))
                        ->update([
                            "program" => $request->get("program"),
                            "ofi" => $request->get("ofi"),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.program', ['journey' => $request->get('journey')]);
    }

    public function priorityUpdateProgram(Request $request){
        try {
            $stat = DB::table('summary_program')
                        ->where('id', '=', $request->get('id'))
                        ->update([
                            "ofi_priority" => $request->get('ofi_priority') ? true : false,
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.program', ['journey' => $request->get('journey')]);
    }

    public function deleteProgram(Request $request, $journey, $id){
        $stat = DB::table('summary_program')
                    ->where('id', $id)
                    ->delete();

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.program', ['journey' => $journey]);
    }

    // ------------------------ SUMMARY PROGRESS HANDLE ------------------------ //
    // ------------------------ SUMMARY PROGRESS HANDLE ------------------------ //
    // ------------------------ SUMMARY PROGRESS HANDLE ------------------------ //

    
    public function showAddProgress(Request $request){
        return view('feature.progress.add');
    }

    public function storeAddProgress(Request $request){
        try {
            $stat = DB::table('summary_progress')
                        ->insert([
                            "program_id" => $request->get("program"),
                            "rencana_aksi" => $request->get("rencana_aksi"),
                            "pic" => $request->get("pic"),
                            "due_date" => $request->get("due_date"),
                            "witel" => implode("|",$request->get("witel")),
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);
        
        return $request->get("action") == "new"
                    ? back() : redirect()->route('dashboard.progress', ['program' => $request->get('program')]);
    }

    
    public function storeUpdateProgress(Request $request){
        try {
            $stat = DB::table('summary_progress')
                        ->where('id', '=', $request->get('id'))
                        ->update([
                            "rencana_aksi" => $request->get("rencana_aksi"),
                            "pic" => $request->get("pic"),
                            "due_date" => $request->get("due_date"),
                            "witel" => implode("|",$request->get("witel")),
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.progress', ['program' => $request->get('program')]);
    }

    public function deleteProgress(Request $request, $program, $id){
        $stat = DB::table('summary_progress')
                    ->where('id', '=', $id)
                    ->delete();

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.progress', ['program' => $program]);
    }
}
