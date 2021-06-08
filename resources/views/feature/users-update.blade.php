@extends('layouts.guest')

@section('content')
<div class="container" style="margin-top: 8%">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', [$id]) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
            
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                            <label for="nik" class="col-md-4 control-label">NIK</label>

                            <div class="col-md-6">
                                <input id="nik" type="nik" class="form-control" name="nik" value="{{ $user->nik }}" disabled>

                                @if ($errors->has('nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('privileges') ? ' has-error' : '' }}">
                            <label for="privileges" class="col-md-4 control-label">Privileges</label>

                            <div class="col-md-6">
                                <select name="privileges" id="role" class="form-control" required>
                                    <option value="{{ __('inputer') }}" {{$user->privileges == 'inputer' ? 'selected' : ''}}>{{ __('Inputer') }}</option>
                                    <option value="{{ __('verifikator') }}" {{$user->privileges == 'verifikator' ? 'selected' : ''}}>{{ __('Verifikator') }}</option>
                                    <option value="{{ __('admin') }}" {{$user->privileges == 'admin' ? 'selected' : ''}}>{{ __('Admin') }}</option>
                                </select>                
                                @if ($errors->has('privileges'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('privileges') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group if-show{{ $errors->has('uic') ? ' has-error' : '' }}" style="{{ $user->privileges != 'inputer' ? 'display:none' : '' }}">
                            <label for="uic" class="col-md-4 control-label">UIC</label>

                            <div class="col-md-6">
                                <select class="form-control" name="uic">
                                    <option value="Consumer Marketing (CM)" {{$user->uic == 'Consumer Marketing (CM)' ? 'selected' : ''}}>Consumer Marketing (CM)</option>
                                    <option value="Regional Operational Center (ROC)" {{$user->uic == 'Regional Operational Center (ROC)' ? 'selected' : ''}}>Regional Operational Center (ROC)</option>
                                    <option value="Access Management (RAM)" {{$user->uic == 'Access Management (RAM)' ? 'selected' : ''}}>Access Management (RAM)</option>
                                    <option value="Regional Network Operation (RNO)" {{$user->uic == 'Regional Network Operation (RNO)' ? 'selected' : ''}}>Regional Network Operation (RNO)</option>
                                    <option value="Payment Collection & Finance (PCF)" {{$user->uic == 'Payment Collection & Finance (PCF)' ? 'selected' : ''}}>Payment Collection & Finance (PCF)</option>
                                    <option value="Customer Care (CC)" {{$user->uic == 'Customer Care (CC)' ? 'selected' : ''}}>Customer Care (CC)</option>
                                </select>
                                @if ($errors->has('privileges'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('privileges') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password ( kosongkan jika tidak ingin di ganti )</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a style="margin-left: 10px" href="{{ url()->previous() }}"> Kembali </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
