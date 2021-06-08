@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Tambah Program</h3>
                    </div>
                    <form action="{{route('dashboard.program.add', ["journey" => Request::get('journey')] )}}" method="POST">
                      {{ csrf_field() }}
                      <div class="card-body">
                        <div class="form-group">
                          <label for="program">Program : </label>
                          <div class="input-group mb-3">
                              <input id="program" name="program" autocomplete="off" type="text" class="form-control" required>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="ofi">OFI : </label>
                        <div class="input-group mb-3">
                            <input id="ofi" name="ofi" autocomplete="off" type="text" class="form-control" required>
                        </div>
                      </div>
                      <div class="card-footer float-right">
                        <button type="submit" name="action" value="new" class="btn btn-success">Save & New</button>
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