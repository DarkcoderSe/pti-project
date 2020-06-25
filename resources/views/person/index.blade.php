@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-1">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ URL::to('/person/create') }} " class="btn btn-success">
                                Add new Person
                            </a>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                People
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone No.</th>
                                <th>NA No.</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($persons as $person)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('/person/edit', $person->id) }} ">
                                        {{ $person->name }} {{ $person->father_name }}
                                    </a>
                                    @php 
                                        $personRegion = $person->Regions->first();
                                    @endphp 
                                    <div class="small text-secondary">
                                        {{ $personRegion->rank }} &bull; {{ $personRegion->Region->name }}
                                    </div>
                                </td>
                                <td>{{ $person->phone_no }} </td>
                                <td>{{ $person->na_no }} </td>
                                <td>
                                    <a href="{{ URL::to('/person/delete', $person->id) }} " class="btn btn-danger btn-sm">
                                        Delete
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
