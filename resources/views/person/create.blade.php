@extends('layouts.master')

@section('pageTitle', 'Add Person')

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
                                Add new Person
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/person') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                        </div>
                    </div>
                </div>

@php
$regionArr = ['Country', 'Province', 'Division', 'District', 'Tehsil', 'Union-Council'];
@endphp 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group col-md-12 mt-3">
                                @php 
                                    $label = "No Region Found. Please add some region first";
                                    $label = $regions->first();
                                @endphp 
                                <label> {{ $label->type }} </label>
                                <select name="" id="{{$label->type}}" class="custom-select">
                                    <option value=""> -- select --</option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="selectedRegion">
                                
                            </div>
                        </div>
                        <div class="col-md-9">
                            <form action="{{ URL::to('person/submit') }} " method="post" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        
                                        <input type="hidden" name="regionId" id="regionId">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    
                                    <div class="col-md-4 form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                        @if($errors->any('name'))
                                        <span class="small text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Father Name</label>
                                        <input type="text" name="fatherName" class="form-control" required>
                                        @if($errors->any('fatherName'))
                                        <span class="small text-danger">
                                            {{ $errors->first('fatherName') }}
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Rank</label>
                                        <input type="text" name="rank" class="form-control" required>
                                        @if($errors->any('rank'))
                                        <span class="small text-danger">
                                            {{ $errors->first('rank') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-row">
                                    
                                    <div class="col-md-4 form-group">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" class="form-control" required>
                                        @if($errors->any('cnic'))
                                        <span class="small text-danger">
                                            {{ $errors->first('cnic') }}
                                        </span>
                                        @endif
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label>Phone No.</label>
                                        <input type="text" name="phone_no" class="form-control" required>
                                        @if($errors->any('phone_no'))
                                        <span class="small text-danger">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                        @endif
                                    </div>
        
        
                                    <div class="form-group col-md-4">
                                        <label>National Assembly No.</label>
                                        <input type="text" name="na_no" class="form-control" required>
                                        @if($errors->any('na_no'))
                                        <span class="small text-danger">
                                            {{ $errors->first('na_no') }}
                                        </span>
                                        @endif
                                    </div>
        
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <textarea name="address" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    Add Person
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $regionArr = ['Country', 'Province', 'Division', 'District', 'Tehsil', 'Union-Council'];
@endphp 

@push('script')
<script>
    
        @foreach($regionArr as $r)

        $(document).on('change', '#{{$r}}', function(){
            console.log("called {{$r}}");
            
            let id = $('#' + '{{$r}}').val();
            let url = '{{ URL::to("/region/find") }}/' + id;
            $.get(url, function(response){
                console.log(response);
                

                if(response.childs.length == 0){
                    $('#regionId').val(id);
                }else{
                    let newField = `<div class='form-group col-md-12'>
                                    <label>${response.childs[0].type}</label>
                                    <select class='custom-select' name='' id='${response.childs[0].type}'>
                                    <option value=''> -- select --</option>`;
                    response.childs.forEach(child => {
                        newField += `<option value='${child.id}'>${child.name}</option>`;
                    });
                    newField += "</select></div>";

                    $('#selectedRegion').append(newField);
                }
            });
        });

        @endforeach
  
</script>

@endpush
@endsection
