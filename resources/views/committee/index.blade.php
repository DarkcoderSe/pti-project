@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ URL::to('/committee/create') }} " class="btn btn-success">
                                Add new Committee
                            </a>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                Committees
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
                                <th>Committee Name</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($committees as $committee)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('/committee/edit', $committee->id) }} ">
                                        {{ $committee->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/committee/delete', $committee->id) }} " class="btn btn-danger btn-sm">
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
