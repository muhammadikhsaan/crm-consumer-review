@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Summary by Program Aksi</h3>
                    </div>
                    <div class="card-header">
                      <h3 class="card-title py-2" style="font-size: 14px"><a class="text-black" href="{{route('dashboard')}}">Journey {{(!empty($journey->journey)) ? $journey->journey : ''}}</a></h3>
                      @if (Auth::user()->privileges == 'admin')
                        <div class="card-tools">
                          <div class="float-right">
                            <div style="background-color: rgb(64,160,185)">
                                <a class="text-white px-3 py-2 d-block" style="font-size: 12px; font-family: 'Font Awesome 5 Free';" href="{{route('dashboard.program.add', ["journey" => Request::get('journey')] )}}">Tambah Program</a>
                            </div>
                          </div>
                        </div>
                      @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>PROGRAM</th>
                            <th>OFI</th>
                            <th style="width: 200px;">UIC</th>
                            <th>LAST UPDATE</th>
                            <th style="width: 40px">PROGRESS</th>
                            @if (Auth::user()->privileges == 'admin')
                              <th style="width: 40px">PRIORITY</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($program as $key => $item)
                            <tr>
                              <td class="tb-number">{{$key+1}}.</td>
                              <td>
                                @if (Auth::user()->privileges == 'admin')
                                  <a class="text-black" href="{{route('dashboard.program.update', ["id" => $item->id, "journey" => Request::get('journey')])}}">{{$item->program}}</a>
                                @else
                                  {{$item->program}}
                                @endif
                              </td>
                              <td>{{$item->ofi}}</td>
                              <td>{{$item->UIC}}</td>
                              @php
                                  $update = DB::table('summary_progress')
                                                ->where('program_id', '=', $item->id)
                                                ->orderBy('progress_update', 'desc')
                                                ->first();
                              @endphp
                              <td>{{(!empty($update->progress_update) ? $update->progress_update : '')}}</td>
                              @php
                                  $ori = DB::table('summary_program')
                                                  ->select(
                                                    DB::raw("(select count(*) from `summary_progress` where `program_id` = {$item->id} and progress_status = 'selesai') as `valid`,
                                                              (select count(*) from `summary_progress` where `program_id` = {$item->id}) as `all`")
                                                              )->first();
                                  $progress = (!empty($ori->all)) ? ceil(($ori->valid/$ori->all)*100) : 100;
                              @endphp
                              <td><a href="{{route('dashboard.progress', ["program" => $item->id])}}" class="progress-percent badge {{ ($progress >= 80) ? 'bg-success' : 'bg-danger' }}">{{ $progress }}%</a></td>
                              @if (Auth::user()->privileges == 'admin')
                                <td>
                                  <form action="{{route('dashboard.program.update.priority', ["id" => $item->id, "journey" => Request::get('journey')])}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="ofi_priority" value="{{!$item->ofi_priority}}">
                                    <button type="submit" style="border: none; font-size:18px; background-color:inherit">
                                      @if ($item->ofi_priority == false)
                                        <i class="far fa-square"></i>
                                      @else
                                        <i class="far fa-check-square"></i>
                                      @endif  
                                    </button>
                                  </form>
                                </td>
                              @endif
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>
    </div>

    {{-- <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title py-2">Summary by Witel</h3>
                  <div class="card-tools">
                    <div class="float-right">
                      <div class="bg-success">
                          <a class="text-white px-3 py-2 d-block" style="font-size: 12px; font-family: 'Font Awesome 5 Free';" href="{{route('dashboard.program.add')}}">Add Progress</a>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>WITEL</th>
                          <th>UIC</th>
                          <th style="width: 40px">Progress</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="tb-number">1.</td>
                          <td>Semarang</td>
                          <td>Consumer Marketing (CM)</td>
                          <td><a href="{{route('dashboard.program', [1])}}" class="progress-percent badge bg-danger">55%</a></td>
                        </tr>
                        <tr>
                          <td>2.</td>
                          <td>Kudus</td>
                          <td>Consumer Marketing (CM)</td>
                          <td><a href="{{route('dashboard.program', [1])}}" class="progress-percent badge bg-danger">55%</a></td>
                        </tr>
                        <tr>
                          <td>3.</td>
                          <td>Yogyakarta</td>
                          <td>Consumer Marketing (CM)</td>
                          <td><a href="{{route('dashboard.program', [1])}}" class="progress-percent badge bg-danger">55%</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
          </div>
      </div>
    </div> --}}
@endsection
