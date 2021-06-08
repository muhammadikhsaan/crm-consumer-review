@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Tambah Aksi</h3>
                    </div>
                    <form action="{{route('dashboard.progress.add', ['program' => Request::get('program')])}}" method="POST">
                      {{ csrf_field() }}
                      <div class="card-body">
                        <div class="form-group">
                            <label for="rencana-aksi">Rencana Aksi</label>
                            <div class="input-group mb-3">
                                <input id="rencana-aksi" required autocomplete="off" type="text" name="rencana_aksi" class="form-control">
                            </div>    
                        </div>
                        <div class="form-group">
                          <label for="pic">PIC</label>
                          <div class="input-group mb-3">
                              <input id="pic" type="text" required autocomplete="off" name="pic" class="form-control">
                          </div>    
                        </div>
                        <div class="form-group">
                          <label for="due_date">Due Date</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <label for="due_date" class="input-group-text"><i class="far fa-calendar-alt"></i></label>
                              </div>
                              <input id="due_date" name="due_date" required autocomplete="off" type="date" value="{{date('Y-m-d')}}" class="form-control" data-date-format="DD/MM/YYYY" data-date="">
                          </div>
                        </div>
                        <div class="form-group" data-select2-id="64">
                          <label for="witel">Witel</label>
                          <select required id="witel" name="witel[]" autocomplete="off" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select a Witel" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">
                            <option data-select2-id="68" value="Kudus">Kudus</option>
                            <option data-select2-id="69" value="Magelang">Magelang</option>
                            <option data-select2-id="70" value="Pekalongan">Pekalongan</option>
                            <option data-select2-id="71" value="Purwokerto">Purwokerto</option>
                            <option data-select2-id="72" value="Semarang">Semarang</option>
                            <option data-select2-id="73" value="Solo">Solo</option>
                            <option data-select2-id="74" value="Yogyakarta">Yogyakarta</option>
                          </select>
                        </div>
                      </div>
                      <div class="card-footer float-right">
                        <button type="submit" name="action" value="new" class="btn btn-success">Save & New</button>
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