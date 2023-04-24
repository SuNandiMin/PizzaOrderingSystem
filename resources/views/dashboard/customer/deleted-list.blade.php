@extends('layouts.admin.nav')
@section('main-content')
<h3>Deleted User List</h3>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="overview-wrap">
                <h2 class="title-1">Customer List</h2>
            </div>
        </div>
        <div class="table-data__tool-right">
            <a href="{{ route('user#restore#all') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                Restore All
            </a>
            <a href="{{ route('user#list') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                UserList
            </a>
        </div>
    </div>

    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                    <th>role</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>deleted At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="tr-shadow">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <span class="block-email">{{ $user->email }}</span>
                        </td>
                        <td>
                            {{ $user->role }}
                        </td>

                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->deleted_at }}</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="mr-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <a href="{{ route('user#restore', $user->id) }}">
                                        Restore
                                    </a>
                                </button>
                                <button class="" data-toggle="tooltip" data-placement="top" title="Delete Permanently">
                                    <a href="{{ route('user#hard#delete', $user->id) }}">
                                        Delete
                                    </a>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
