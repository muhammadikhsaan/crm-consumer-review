@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Update Program</h3>
                      <div class="card-tools">
                        <div class="float-right mx-2">
                          <div class="bg-danger">
                            <form action="{{route('dashboard.program.delete', ["id" => Request::get('id'), "journey" => Request::get('journey')])}}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="text-white px-3 py-2 d-block bg-ih" style="font-size: 12px; font-family: 'Font Awesome 5 Free';">Delete</button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="{{route('dashboard.program.update', ["id" => Request::get('id'), "journey" => Request::get('journey')] )}}" method="POST">
                      {{ method_field('PUT') }}
                      {{ csrf_field() }}
                      <div class="card-body">
                        <div class="form-group">
                          <label for="program">Program</label>
                          <div class="input-group mb-3">
                            <input id="program" name="program" autocomplete="off" type="text" class="form-control" value="{{$value->program}}" required>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="ofi">OFI</label>
                        <div class="input-group mb-3">
                            <input id="ofi" name="ofi" autocomplete="off" type="text" class="form-control" value="{{$value->ofi}}" required>
                        </div>
                      </div>
                      <div class="card-footer float-right">
                        <button type="submit" name="action" value="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
@endsection