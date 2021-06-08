@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Detail Program</h3>
                    </div>
                    <div class="card-header">
                      <h3 class="card-title py-2" style="font-size: 14px"><a class="text-black" href="{{route('dashboard.program', ['journey' => $program->journey_id])}}">{{(!empty($program->program)) ? $program->program : ''}}</a></h3>
                      @if (Auth::user()->privileges == 'admin')
                        <div class="card-tools">
                          <div class="float-right">
                            <div style="background-color: rgb(64,160,185)">
                                <a class="text-white px-3 py-2 d-block" style="font-size: 12px; font-family: 'Font Awesome 5 Free';" href="{{route('dashboard.progress.add', ['program' => Request::get('program')])}}">Tambah Aksi</a>
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
                            <th>RENCANA AKSI</th>
                            <th>PROGRESS</th>
                            <th>PIC</th>
                            <th>DUE DATE</th>
                            <th>EVIDENCE</th>
                            <th style="width: 10px;">WITEL</th>
                            <th>NOTE</th>
                            <th>STATUS</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($progress as $key => $item)
                            <tr>
                              <td class="tb-number">{{$key+1}}.</td>
                              <td>
                                @if (Auth::user()->privileges == 'verifikator')
                                  {{$item->rencana_aksi}}
                                @else
                                  @if (Auth::user()->privileges == 'admin')
                                    @if ($item->progress_status == "berjalan")
                                      <a class="text-black" href="{{route('dashboard.progress.update', ['id' => $item->id, 'program' => $item->program_id])}}">{{$item->rencana_aksi}}</a>
                                    @else
                                      {{$item->rencana_aksi}}
                                    @endif
                                  @else
                                    @if ($item->progress_status == "berjalan")
                                      <a class="text-black" href="{{route('dashboard.progress.update.inputer', ['id' => $item->id, 'program' => $item->program_id])}}">{{$item->rencana_aksi}}</a>
                                    @else
                                      {{$item->rencana_aksi}}
                                    @endif
                                  @endif
                                @endif
                              </td>
                              <td>{{$item->progress}}</td>
                              <td>{{$item->pic}}</td>
                              <td>{{date('d F Y', strtotime($item->due_date))}}</td>
                              <td>
                                @if (!empty($item->evidence))
                                  <a class="text-black" href="{{asset("upload/{$item->program_id}/$item->evidence")}}">klik disini</a>
                                @else
                                    -
                                @endif
                              </td>
                              <td>{{str_replace("|", ", ", $item->witel)}}</td>
                              <td>{{$item->note}}</td>
                              @if (Auth::user()->privileges == 'admin')
                                @if ($item->progress_status == "berjalan")
                                  <td><span class="badge p-2 bg-danger">{{ucfirst($item->progress_status)}}</span></td>
                                @else
                                <td><span class="badge p-2 {{($item->progress_status == "menunggu") ? 'bg-warning' : 'bg-success'}}">{{ucfirst($item->progress_status)}}</span></td>
                                @endif
                              @else
                                @if (Auth::user()->privileges == 'inputer')
                                  @if($item->progress_status == "berjalan")
                                    <td>
                                      <form action="{{route('dashboard.progress.update.status.inputer', ['id' => $item->id])}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button class="badge bg-danger p-2" type="submit" name="progress_status" value="menunggu">{{ucfirst($item->progress_status)}}</button>
                                      </form>
                                    </td>
                                  @else
                                    <td><span class="badge p-2 {{($item->progress_status == "menunggu") ? 'bg-warning' : "bg-success"}}">{{ucfirst($item->progress_status)}}</span></td>
                                  @endif
                                @else
                                  @if ($item->progress_status == "menunggu")
                                    <td>
                                      <form action="{{route('dashboard.progress.update.status.verifikator', ['id' => $item->id])}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button class="badge bg-success p-2" type="submit" name="progress_status" value="selesai">Selesai</button>
                                        <button class="badge bg-danger p-2" type="submit" name="progress_status" value="berjalan">Perbaiki</button>
                                      </form>
                                    </td>
                                  @else
                                    <td><span class="badge p-2 {{($item->progress_status == "berjalan") ? 'bg-danger' : "bg-success"}}">{{ucfirst($item->progress_status)}}</span></td>
                                  @endif
                                @endif
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
@endsection
