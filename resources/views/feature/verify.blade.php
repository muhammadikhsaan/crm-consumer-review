@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="card my-15">
                <div class="card-header">
                  <h3 class="card-title">Rencana Aksi (Verifikasi)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Journey</th>
                        <th>Program</th>
                        <th>Rencana Aksi</th>
                        <th>Due Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($actionVerify as $key => $item)
                        <tr>
                          <td>{{$actionVerify->firstItem() + $key}}.</td>
                          <td><a class="text-black" href="{{route('dashboard')}}">{{$item->journey}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.program', ["journey" => $item->journey_id])}}">{{$item->program}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.progress', ["program" => $item->program_id])}}">{{$item->rencana_aksi}}</a></td>
                          <td>{{$item->due_date}}</td>
                          <td>
                            <form action="{{route('dashboard.progress.update.status.verifikator', ['id' => $item->id])}}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <button class="badge bg-success p-2" type="submit" name="progress_status" value="selesai">Selesai</button>
                              <button class="badge bg-danger p-2" type="submit" name="progress_status" value="berjalan">Perbaiki</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer clearfix pagination-custom">
                  {{$actionVerify->appends(['running' => $actionRunning->currentPage(), 'finish' => $actionFinish->currentPage()])->links()}}
                </div>
                <!-- /.card-body -->
              </div>
              
              <div class="card my-15">
                <div class="card-header">
                  <h3 class="card-title">Verifikasi Rencana Aksi (Progress)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Journey</th>
                        <th>Program</th>
                        <th>Rencana Aksi</th>
                        <th>Due Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($actionRunning as $key => $item)
                        <tr>
                          <td>{{$actionRunning->firstItem() + $key}}.</td>
                          <td><a class="text-black" href="{{route('dashboard')}}">{{$item->journey}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.program', ["journey" => $item->journey_id])}}">{{$item->program}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.progress', ["program" => $item->program_id])}}">{{$item->rencana_aksi}}</a></td>
                          <td>{{$item->due_date}}</td>
                          <td><span class="badge p-2 bg-danger">{{ucfirst($item->progress_status)}}</span></td>
                        </tr>
                      @endforeach 
                    </tbody>
                  </table>
                </div>
                <div class="card-footer clearfix">
                  {{$actionRunning->appends(['verify' => $actionVerify->currentPage(), 'finish' => $actionFinish->currentPage()])->links()}}
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card my-15">
                <div class="card-header">
                  <h3 class="card-title">Verifikasi Rencana Aksi (Selesai)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Journey</th>
                        <th>Program</th>
                        <th>Rencana Aksi</th>
                        <th>Due Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($actionFinish as $key => $item)
                        <tr>
                          <td>{{$actionFinish->firstItem() + $key}}.</td>
                          <td><a class="text-black" href="{{route('dashboard')}}">{{$item->journey}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.program', ["journey" => $item->journey_id])}}">{{$item->program}}</a></td>
                          <td><a class="text-black" href="{{route('dashboard.progress', ["program" => $item->program_id])}}">{{$item->rencana_aksi}}</a></td>
                          <td>{{$item->due_date}}</td>
                          <td><span class="badge p-2 bg-success">{{ucfirst($item->progress_status)}}</span></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer clearfix">
                  {{$actionFinish->appends(['running' => $actionRunning->currentPage(), 'verify' => $actionVerify->currentPage()])->links()}}
                </div>
                <!-- /.card-body -->
              </div>
            </div>
        </div>
    </div>
@endsection
