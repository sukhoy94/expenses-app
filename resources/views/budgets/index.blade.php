@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-3">
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">period</th>
                <th scope="col">budget</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
            </tbody>
        </table>
    </div>
@endsection