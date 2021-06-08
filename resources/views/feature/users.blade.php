@extends('layouts.app')

@section('content')
    <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
             <section class="content">
                <div class="container-fluid">
                   <div class="row">
                      <div class="col-12">
                         <div class="card">
                            <div class="card-header d-flex flex-row-reverse">
                                <div style="background-color: rgb(64,160,185)">
                                    <a class="text-white px-3 py-2 d-block" style="font-size: 12px; font-family: 'Font Awesome 5 Free';" href="{{route('register')}}">Tambah User</a>
                                </div>
                            </div>
                            <div class="card-header">
                               <h3 class="card-title text-bold">List User</h3>
                               <ul class="d-flex flex-row-reverse">
                                    <form class="form-inline ml-3">
                                        <div class="input-group input-group-sm" style="width: 300px">
                                        <input class="form-control form-control-navbar" type="input" placeholder="Search by name or nik" autocomplete="off" name="by" aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit" style="border: 1px solid #d2d6dc;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        </div>
                                    </form>
                               </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                               <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                  <div class="row">
                                     <div class="col-sm-12 col-md-6"></div>
                                     <div class="col-sm-12 col-md-6"></div>
                                  </div>
                                  <div class="row">
                                     <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                           <thead>
                                              <tr role="row">
                                                 <th class="text-center">Name</th>
                                                 <th class="text-center">NIK</th>
                                                 <th class="text-center">Role</th>
                                                 <th class="text-center" colspan="2">Action</th>
                                              </tr>
                                           </thead>
                                           <tbody>
                                               @foreach ($users as $item)
                                               <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">{{$item->name}}</td>
                                                    <td class="">{{$item->nik}}</td>
                                                    <td class="">{{$item->privileges}}</td>
                                                    <td class="text-center text-success"><a href="{{route('users.update', [$item->id])}}">{{ __('Update') }}</a></td>
                                                    <td class="text-center">
                                                        <form action="{{route('users.delete',[$item->id])}}" method="POST" onsubmit="return confirm('Delete User {{$item->nik}}') || event.preventDefault()">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button class="text-danger bg-ih" style="border:none;font-family: emoji;" type="submit">{{ __('Delete') }}</button>               
                                                        </form>
                                                    </td>
                                                </tr>                                                  
                                               @endforeach
                                           </tbody>
                                        </table>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <!-- /.card-body -->
                         </div>
                         <!-- /.card -->
                      </div>
                      <!-- /.col -->
                   </div>
                   <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
             </section>
          </div>
       </div>
    </div>
 @endsection