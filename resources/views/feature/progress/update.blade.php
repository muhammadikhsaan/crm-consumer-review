@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Update Aksi</h3>
                      <div class="card-tools">
                        <div class="float-right mx-2">
                          <div class="bg-danger">
                            <form action="{{route('dashboard.progress.delete', [Request::get('program'), Request::get('id')])}}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="text-white px-3 py-2 d-block bg-ih" style="font-size: 12px; font-family: 'Font Awesome 5 Free';">Delete</button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="{{route('dashboard.progress.update', ['id' => Request::get('id'), 'program' => Request::get('program')])}}" method="POST">
                      {{ method_field('PUT') }}
                      {{ csrf_field() }}
                      <div class="card-body">
                        <div class="form-group">
                            <label for="rencana-aksi">Rencana Aksi</label>
                            <div class="input-group mb-3">
                                <input id="rencana-aksi" required value="{{$value->rencana_aksi}}" autocomplete="off" type="text" name="rencana_aksi" class="form-control">
                            </div>    
                        </div>
                        <div class="form-group">
                          <label for="pic">PIC</label>
                          <div class="input-group mb-3">
                              <input id="pic" type="text" required value="{{$value->pic}}" autocomplete="off" name="pic" class="form-control">
                          </div>    
                        </div>
                        <div class="form-group">
                          <label for="due_date">Due Date</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <label for="due_date" class="input-group-text"><i class="far fa-calendar-alt"></i></label>
                              </div>
                              <input id="due_date" required name="due_date" autocomplete="off" type="date" value="{{date('Y-m-d', strtotime($value->due_date))}}" class="form-control" data-date-format="DD/MM/YYYY" data-date="">
                          </div>
                        </div>
                        <div class="form-group" data-select2-id="64">
                          <label for="witel">Witel</label>
                          <select id="witel" required name="witel[]" autocomplete="off" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select a Witel" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">
                            <option data-select2-id="68" value="Kudus" {{in_array("Kudus", explode("|", $value->witel)) ? 'selected' : ''}}>Kudus</option>
                            <option data-select2-id="69" value="Magelang" {{in_array("Magelang", explode("|", $value->witel)) ? 'selected' : ''}}>Magelang</option>
                            <option data-select2-id="70" value="Pekalongan" {{in_array("Pekalongan", explode("|", $value->witel)) ? 'selected' : ''}}>Pekalongan</option>
                            <option data-select2-id="71" value="Purwokerto" {{in_array("Purwokerto", explode("|", $value->witel)) ? 'selected' : ''}}>Purwokerto</option>
                            <option data-select2-id="72" value="Semarang" {{in_array("Semarang", explode("|", $value->witel)) ? 'selected' : ''}}>Semarang</option>
                            <option data-select2-id="73" value="Solo" {{in_array("Solo", explode("|", $value->witel)) ? 'selected' : ''}}>Solo</option>
                            <option data-select2-id="74" value="Yogyakarta" {{in_array("Yogyakarta", explode("|", $value->witel)) ? 'selected' : ''}}>Yogyakarta</option>
                          </select>
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