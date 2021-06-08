<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikatorController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function dataForchecked(Request $request){
        return view('feature.verify', [
            'actionRunning' => DB::table('summary_progress')
                            ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                            ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                            ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->where('summary_progress.progress_status', '=', 'berjalan')
                            ->orderBy('progress_update', 'desc')
                            ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                            ->paginate(10, ['*'], 'running'),
            'actionVerify' => DB::table('summary_progress')
                            ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                            ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                            ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->where('summary_progress.progress_status', '=', 'menunggu')
                            ->orderBy('progress_update', 'desc')
                            ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                            ->paginate(10, ['*'], 'verify'),
            'actionFinish' => DB::table('summary_progress')
                            ->join('summary_program', 'summary_progress.program_id', '=', 'summary_program.id')
                            ->join('summary_journey', 'summary_program.journey_id', '=', 'summary_journey.id')
                            ->join('journey_list', 'summary_journey.journey_id', '=', 'journey_list.id')
                            ->where('summary_progress.progress_status', '=', 'selesai')
                            ->orderBy('progress_update', 'desc')
                            ->select('journey_list.journey', 'summary_program.journey_id', 'summary_progress.program_id', 'summary_program.program', 'summary_progress.id', 'summary_progress.rencana_aksi', 'summary_progress.due_date', 'summary_progress.progress_status')
                            ->paginate(10, ['*'], 'finish'),
        ]);
    }
}
