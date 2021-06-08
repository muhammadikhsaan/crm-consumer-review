@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Input Aksi</h3>
                    </div>
                    <form action="{{route('dashboard.progress.update.inputer', ['id' => Request::get('id'), 'program' => Request::get('program')])}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="card-body">
                        <div class="form-group">
                            <label for="rencana-aksi">Rencana Aksi</label>
                            <div class="input-group mb-3">
                              <input id="rencana-aksi" value="{{$value->rencana_aksi}}" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="pic">PIC</label>
                          <div class="input-group mb-3">
                              <input id="pic" value="{{$value->pic}}" type="text" class="form-control" disabled>
                          </div>    
                        </div>
                        <div class="form-group">
                          <label for="progress">Progress</label>
                          <div class="input-group mb-3">
                            <input id="progress" value="{{$value->progress}}" name="progress" type="text" class="form-control">
                          </div>    
                        </div>
                        <div class="form-group">
                          <label for="evidence">Evidence</label>
                          <div class="input-group mb-3">
                              <div class="custom-file">
                                  <input type="file" name="evidence" class="custom-file-input" id="customFile">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <div class="input-group mb-3">
                                <textarea id="note" name="note" class="form-control" rows="3" style="resize: none;">{{$value->note}}</textarea>
                            </div>
                        </div>
                      <div class="card-footer float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
@endsection