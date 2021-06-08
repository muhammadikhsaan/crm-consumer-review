@extends('layouts.app')

@section('content')
    <div style="padding: 20px 100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(108,117,126);color: white;">
                      <h3 class="card-title py-2">Update Journey</h3>
                      <div class="card-tools">
                        <div class="float-right mx-2">
                          <div class="bg-danger">
                            <form action="{{route('dashboard.journey.delete', [$value->id])}}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="text-white px-3 py-2 d-block bg-ih" style="font-size: 12px; font-family: 'Font Awesome 5 Free';">Delete</button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="{{route('dashboard.journey.update', ["id" => $value->id])}}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="journey">Nama Journey</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" required name="journey_id">
                                        @foreach ($journey as $item)
                                            <option value="{{$item->id}}" {{($value->journey_id == $item->id) ? 'selected' : ''}}>{{$item->journey}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="npsn">Score NPS (N)</label>
                                <div class="input-group mb-3">
                                <input id="npsn" name="npsn" required type="number" placeholder="0" class="form-control" value="{{$value->npsn}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npsnn">Score NPS (N-1)</label>
                                <div class="input-group mb-3">
                                    <input id="npsnn" name="npsnn" required type="number" placeholder="0" class="form-control" value="{{$value->npsnn}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ofi">OFI</label>
                                <div class="input-group mb-3">
                                    <input id="ofi" name="ofi" required type="number" placeholder="0" class="form-control" min="0" value="{{$value->ofi}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="periode">Periode</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" required name="journey_periode">
                                        @for ($i = 0; $i < 12; $i++)
                                            @php
                                                $y0 = date('Y');
                                                $y1 = date('Y')-1;
                                                $m0 = date('m')-$i;
                                                $m1 = date('m')-$i+12;
                                            @endphp
                                            @if (date("m") - $i <= 0)
                                                <option value="{{date('Y-m-01', strtotime("{$y1}-{$m1}-01"))}}" {{date('Y-m-01', strtotime("{$y1}-{$m1}-01")) == date('Y-m-01', strtotime($value->journey_periode)) ? 'selected' : '' }}>{{date('01/m/Y', strtotime("{$y1}-{$m1}-01")).' sampai '.date('t/m/Y', strtotime("{$y1}-{$m1}-01"))}}</option>
                                            @else
                                                <option value="{{date('Y-m-01', strtotime("{$y0}-{$m0}-01"))}}" {{date('Y-m-01', strtotime("{$y0}-{$m0}-01")) == date('Y-m-01', strtotime($value->journey_periode)) ? 'selected' : '' }}>{{date('01/m/Y', strtotime("{$y0}-{$m0}-01")).' sampai '.date('t/m/Y', strtotime("{$y0}-{$m0}-01"))}}</option>                                                
                                            @endif
                                        @endfor    
                                    </select>
                                </div>
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