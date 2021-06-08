@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Jurnal 1</h3>
                        </div>
                        <form method="POST">
                          <div class="card-body">
                            <div class="form-group">
                                <label for="journey">Nama Journey</label>
                                <div class="input-group mb-3">
                                    <input id="journey" type="text" class="form-control">
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="progress">Progress</label>
                                <div class="input-group mb-3">
                                    <input id="progress" type="number" class="form-control" value="0" min="0" max="100">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npsn">Score NPS (N)</label>
                                <div class="input-group mb-3">
                                    <input id="npsn" type="number" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npsn-1">Score NPS (N-1)</label>
                                <div class="input-group mb-3">
                                    <input id="npsn-1" type="number" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="uic">UIC</label>
                                <div class="input-group mb-3">
                                    <input id="uic" type="text" class="form-control">
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="pra">Perbaikan/Rencana Aksi</label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" style="resize: none;"></textarea>
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="action-plan">Action Plan</label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pr">Progress</label>
                                <div class="input-group mb-3">
                                    <input id="pr" type="text" class="form-control">
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="update">Tanggal Update</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input id="update" type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" inputmode="numeric">
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="progress">Evidence</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <div class="input-group mb-3">
                                    <textarea id="note" class="form-control" rows="3" style="resize: none;"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection