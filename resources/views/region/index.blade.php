@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ URL::to('/region/create') }} " class="btn btn-success">
                                Add new Region
                            </a>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                Regions
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Region Name</th>
                                <th>Parent Region</th>
                                <th>Type</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($regions as $region)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('/region/edit', $region->id) }} ">
                                        {{ $region->name }}
                                    </a>
                                </td>
                                <td>{{ $region->Parent ? $region->Parent->name : ' - ' }} </td>
                                <td>{{ $region->type }} </td>
                                <td>
                                    <a href="{{ URL::to('/region/delete', $region->id) }} " class="btn btn-danger btn-sm">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
