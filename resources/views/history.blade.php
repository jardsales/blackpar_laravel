@extends('layouts.main')

@section('title', 'YouTube API')

@section('content')
@include('layouts/navbar')

<div class="body" id="body">
    @if(!empty($histories))
    <table class="table">
        <thead>
            <tr>
                <th>Termo</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($histories as $history)
            <tr>
                <td>{{ $history["query"] }}</td>
                <td>{{ date("d/m/Y H:i",$history["time"]) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    {{ $error }}
    @endif
</div>
@endsection