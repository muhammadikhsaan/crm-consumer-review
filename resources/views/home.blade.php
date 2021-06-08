@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card">
                @if (Auth::user()->privileges == 'admin')
                  <div class="card-header d-flex flex-row-reverse">
                    <div style="background-color: rgb(64,160,185)">
                      <a class="text-white px-3 py-2 d-block" style="font-size: 12px; font-family: 'Font Awesome 5 Free';" href="{{route('dashboard.journey.add')}}">Tambah Jurnal</a>
                    </div>
                  </div>
                @endif
                <div class="card-header">
                  <h3 class="card-title">SUMMARY</h3>
                  <div class="card-tools">
                    <form action="{{route('dashboard')}}" method="GET" class="form-inline ml-3">
                      <div class="input-group input-group-sm">
                        <select class="custom-select" required name="s">
                          @for ($i = 0; $i < 12; $i++)
                              @php
                                  $y0 = date('Y');
                                  $y1 = date('Y')-1;
                                  $m0 = date('m')-$i;
                                  $m1 = date('m')-$i+12;
                              @endphp
                              @if (date("m") - $i <= 0)
                                  <option value="{{date('Y-m-01', strtotime("{$y1}-{$m1}-01"))}}" {{date('Y-m-01', strtotime("{$y1}-{$m1}-01")) == Request::get('s') ? 'selected' : ''}}>{{date('01/m/Y', strtotime("{$y1}-{$m1}-01")).' sampai '.date('t/m/Y', strtotime("{$y1}-{$m1}-01"))}}</option>
                              @else
                                  <option value="{{date('Y-m-01', strtotime("{$y0}-{$m0}-01"))}}" {{date('Y-m-01', strtotime("{$y0}-{$m0}-01")) == Request::get('s') ? 'selected' : ''}}>{{date('01/m/Y', strtotime("{$y0}-{$m0}-01")).' sampai '.date('t/m/Y', strtotime("{$y0}-{$m0}-01"))}}</option>                                                
                              @endif
                          @endfor    
                        </select>
                        <div class="input-group-append">
                          <button class="btn btn-navbar" type="submit" style="border: 1px solid #ced4da;">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0">
                  <table class="table main-dashboard">
                    <thead>
                      <tr class="bg-danger">
                        <th style="width: 10px" rowspan="2">#</th>
                        <th rowspan="2">JOURNEY</th>
                        <th style="width: 15%">NPS (N)</th>
                        <th style="width: 15%">NPS (N-1)</th>
                        <th style="width: 15%">OFI</th>
                        <th rowspan="2">PROGRAM AKSI</th>
                        <th rowspan="2">UIC</th>
                        <th rowspan="2">PROGRESS</th>
                      </tr>
                      <tr class="bg-danger">
                        <th colspan="3">OFI Survey</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($journey as $key => $item)
                        <tr class="{{ $key%2==0 ? '' : 'bg-opacity-05' }}">
                          <td rowspan="4">{{$key+1}}.</td>
                          <td rowspan="4">
                            @if (Auth::user()->privileges == 'admin')
                              <a class="text-black" href="{{route('dashboard.journey.update', ["id" => $item->id])}}">{{$item->journey}}</a>                                    
                            @else
                              {{$item->journey}}
                            @endif
                          </td>
                          <td>{{$item->npsn}}</td>
                          <td>{{$item->npsnn}}</td>
                          <td>{{$item->ofi}}</td>
                          @php
                            $pr = DB::table('summary_program')
                              ->where('journey_id', '=', $item->id)
                              ->select(DB::raw('count(program) as program'))
                              ->first();
                          @endphp
                          <td rowspan="4">{{empty($pr->program) ? 0 : $pr->program}} Program</td>
                          <td rowspan="4">{{$item->UIC}}</td>
                          @php
                            $ori = DB::table('summary_program')
                                            ->select(
                                              DB::raw("(select count(*) from `summary_program` inner join `summary_progress` on `summary_progress`.`program_id` = `summary_program`.`id` where `summary_program`.`journey_id` = {$item->id} and `summary_progress`.`progress_status` = 'selesai') as `valid`,
                                                        (select count(*) from `summary_program` inner join `summary_progress` on `summary_progress`.`program_id` = `summary_program`.`id` where `summary_program`.`journey_id` = {$item->id}) as `all`")
                                                        )->first();
                            $progress = (!empty($ori->all)) ? ceil(($ori->valid/$ori->all)*100) : 100;
                          @endphp
                          <td rowspan="4"><a href="{{route('dashboard.program', ["journey" => $item->id])}}" class="progress-percent badge {{ ($progress >= 80) ? 'bg-success' : 'bg-danger' }}">{{$progress}}%</a></td>
                        </tr>
                        @php
                            $ofi = DB::table('summary_program')
                              ->where('journey_id', '=', $item->id)
                              ->where('ofi_priority', '=', true)
                              ->orderBy('updated_at', 'desc')
                              ->select('id', 'ofi')
                              ->paginate(3);
                        @endphp
                        @for ($i = 0; $i <= 2; $i++)
                          <tr class="{{ $key%2==0 ? '' : 'bg-opacity-05' }}">
                            <td colspan="3">
                              @if ($ofi[$i])
                                <a class="text-black" href="">{{$ofi[$i]->ofi}}</a>                                    
                              @endif
                            </td>
                          </tr>                                
                        @endfor
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</div>
@endsection
