@extends('layouts.dashboard')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">{{ __('Users') }}</span>
                    <a class="float-right" href="{{ route('users.create') }}">New</a>
                </div>

                <div class="card-body">
                   <table class="table table-sm tblborder">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('users.edit',$user->id) }}">
                                      <i class="fas fa-edit"></i>
                                    </a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <!-- <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-trash-alt"></i></button> -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                  
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection