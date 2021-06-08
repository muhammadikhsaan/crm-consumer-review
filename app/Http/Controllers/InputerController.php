<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InputerController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function inputProgress(Request $request){
        return view('feature.progress.inputer', [
            'value' => DB::table('summary_progress')
                            ->where('id', '=', $request->get('id'))
                            ->first()
        ]);
    }

    public function storeInputProgress(Request $request){
        if ($file = $request->file('evidence')) {
            $time = time();
            $filename = "{$request->get('id')}_{$time}_{$file->getClientOriginalName()}";
            $file->move(public_path("upload/{$request->get('program')}"), $filename);                        
        }

        $up = [
            "progress" => $request->get("progress"),
            "note" => $request->get("note"),
            "progress_update" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];

        if(!empty($filename)) $up["evidence"] = $filename;

        $stat = DB::table('summary_progress')
                    ->where('id', '=', $request->get('id'))
                    ->update($up);
        try {
        } catch (\Throwable $th) {
            return  redirect()->route('dashboard');
        }

        $request->session()->flash('status', $stat);

        return redirect()->route('dashboard.progress', ['program' => $request->get('program')]);
    }

    public function dataForinput(Request $request)
    {
        return view('feature.task', [
            'actionRunning' => DB::table('summary_progress')
                        ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                        ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                        ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                        ->where('summary_progress.progress_status', '=', 'berjalan')
                        ->where('summary_progress.progress_status', '=', 'berjalan')
                        ->where('journey_list.uic', '=', Auth::user()->uic)
                        ->orderBy('progress_update', 'desc')
                        ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                        ->paginate(10, ['*'], 'running'),
            'actionVerify' => DB::table('summary_progress')
                        ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                        ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                        ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                        ->where('summary_progress.progress_status', '=', 'menunggu')
                        ->where('journey_list.uic', '=', Auth::user()->uic)
                        ->orderBy('progress_update', 'desc')
                        ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                        ->paginate(10, ['*'], 'verify'),
            'actionFinish' => DB::table('summary_progress')
                        ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                        ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                        ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                        ->where('summary_progress.progress_status', '=', 'selesai')
                        ->where('journey_list.uic', '=', Auth::user()->uic)
                        ->orderBy('progress_update', 'desc')
                        ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                        ->paginate(10, ['*'], 'finish'),
        ]);
    }
}
