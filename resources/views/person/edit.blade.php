@extends('layouts.master')

@section('pageTitle', 'Edit Person Record')

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
                                Modify Person Record
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
$personRegion = $person->Regions->first();
@endphp 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3" id="newRegion" style="display: none;">
                            <div class="form-group col-md-12 mt-3">
                                @php 
                                    $label = "No Region Found. Please add some region first";
                                    $label = $parentRegions->first();
                                @endphp 
                                <label> {{ $label->type }} </label>
                                <select name="" id="{{$label->type}}" class="custom-select">
                                    <option value=""> -- select --</option>
                                    @foreach($parentRegions as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="selectedRegion">
                                
                            </div>
                        </div>
                        <div class="col-md-3" id="oldRegion">
                            <div class="form-group col-md-12 mt-3">
                               
                                <label> {{ $personRegion->Region->type }} </label>
                                <select name="" id="{{$personRegion->Region->type}}" class="custom-select">
                                    <option value="{{ $personRegion->Region->id }}">{{ $personRegion->Region->name }} - SELECTED </option>
                                    @foreach($regions as $regionRow)
                                    <option value="{{ $regionRow->id }}">{{ $regionRow->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-2 col-md-11 m-2" style="border-radius: 5px; background-color: #eee;color:#555;">
                                <a href="#" id="changeParentRegion">Click here</a> if you want to change the parent region!
                            </div>
                        </div>
                        <div class="col-md-9">
                            <form action="{{ URL::to('person/update') }}" method="post" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="personId" value="{{ $person->id }}">
                                        <input type="hidden" name="regionId" id="regionId" value="{{$personRegion->Region->id}}">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    
                                    <div class="col-md-4 form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $person->name }}" required>
                                        @if($errors->any('name'))
                                        <span class="small text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Father Name</label>
                                        <input type="text" name="fatherName" class="form-control" value="{{ $person->father_name }}" required>
                                        @if($errors->any('fatherName'))
                                        <span class="small text-danger">
                                            {{ $errors->first('fatherName') }}
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Rank</label>
                                        <input type="text" name="rank" class="form-control" value="{{ $personRegion->rank }}" required>
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
                                        <input type="text" name="cnic" class="form-control" value="{{ $person->cnic }}" required>
                                        @if($errors->any('cnic'))
                                        <span class="small text-danger">
                                            {{ $errors->first('cnic') }}
                                        </span>
                                        @endif
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label>Phone No.</label>
                                        <input type="text" name="phone_no" class="form-control" value="{{ $person->phone_no }}" required>
                                        @if($errors->any('phone_no'))
                                        <span class="small text-danger">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                        @endif
                                    </div>
        
        
                                    <div class="form-group col-md-4">
                                        <label>National Assembly No.</label>
                                        <input type="text" name="na_no" class="form-control" value="{{ $person->na_no }}" required>
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
                                        <textarea name="address" rows="4" class="form-control">{{ $person->address }}</textarea>
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
    </div>
</div>

@php
    $regionArr = ['Country', 'Province', 'Division', 'District', 'Tehsil', 'Union-Council'];
@endphp 

@push('script')
<script>

        $(document).ready(function(){
            $('#changeParentRegion').on('click', function(){
                $('#oldRegion').hide();
                $('#newRegion').show();
            })
        });
    
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
