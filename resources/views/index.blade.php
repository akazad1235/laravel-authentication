
@extends('layouts.master')
@section('content')

    <div class="card card-preview">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if(Session::has('msg'))
                <div class="alert alert-success">{{session::get('msg')}}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{session::get('error')}}</div>
            @endif
        <div class="card-inner">
            <form action="{{route('home')}}" method="post">
                @csrf
                <div class="preview-block">
                    <span class="preview-title-lg overline-title">User Register</span>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-01">User Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="default-01" name="user_name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-05">Email</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" name="email" id="default-05" placeholder="user Email">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Select User Type</label>
                                <div class="form-control-wrap">
                                   <select class="form-control" name="user_type" data-mce-placeholder="select User Type">

                                       @foreach($getUserType as $value)
                                           <option value="{{$value['id']}}">{{$value['role_type']}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-05">Password</label>
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control" name="password" id="default-05" placeholder="Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info " style="margin-top: 30px">Submit</button>
            </form>
            </div>
        </div>
    </div><!-- .card-preview -->


    {{-- end form --}}
@endsection

