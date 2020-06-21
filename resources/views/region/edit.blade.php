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
                                Modify Region
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
                    <form action="{{ URL::to('region/update') }} " method="post" >
                        @csrf
                        <input type="hidden" name="regionId" value="{{ $region->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Parent Region</label>
                                <select name="parentId" class="custom-select">
                                    <option value="{{ $region->parent_id }}"> 
                                        {{ $region->Parent ? $region->Parent->name : ' - ' }}
                                    </option>
                                    @foreach($regions as $regionRow)
                                    <option value="{{ $regionRow->id }} ">{{ $regionRow->name }} ({{$regionRow->type}}) </option>
                                    @endforeach
                                    <option value=""> N/A </option>
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
                                <input type="text" name="name" class="form-control" value="{{ $region->name }}" required>
                                @if($errors->any('name'))
                                <span class="small text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control" value="{{ $region->type }}" required>
                                @if($errors->any('type'))
                                <span class="small text-danger">
                                    {{ $errors->first('type') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
