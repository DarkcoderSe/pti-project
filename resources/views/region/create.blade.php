@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <h4>
                                Add new Region
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/region') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('region/submit') }} " method="post" >
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Parent Region</label>
                                <select name="parentId" class="custom-select">
                                    <option value=""> N/A </option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }} ">{{ $region->name }} ({{$region->type}}) </option>
                                    @endforeach
                                </select>
                                @if($errors->any('regionId'))
                                <span class="small text-danger">
                                    {{ $errors->first('regionId') }}
                                </span>
                                @endif
                            </div>
                        
                        </div>
                        
                        <div class="form-row">
                            
                            <div class="col-md-6 form-group">
                                <label>Region Name</label>
                                <input type="text" name="name" class="form-control" required>
                                @if($errors->any('name'))
                                <span class="small text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control" required>
                                @if($errors->any('type'))
                                <span class="small text-danger">
                                    {{ $errors->first('type') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
