@extends('layouts.app')

@section('content')
<table class="table">
    @foreach($items as $item)
        <tr class="table-hover">
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
</table>
@endsection