@extends('layouts.dashboard')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">{{ __('Streams') }}</span>
                    <a class="float-right" href="{{ route('streams.create') }}">New</a>
                </div>

                <div class="card-body">

                   <table class="table table-sm tblborder">
                        <tr>
                            <th>Course Name</th>
                            <th>Stream Name</th>
                            <th width="280px">Action</th>
                        </tr>

                        @foreach ($streams as $stream)
                        <tr>
                            <td>{{ $stream->course->name }}</td>
                            <td>{{ $stream->name }}</td>
                            <td>
                                <form action="{{ route('streams.destroy',$stream->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('streams.edit',$stream->id) }}">
                                      <i class="fas fa-edit"></i>
                                    </a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $streams->links() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection