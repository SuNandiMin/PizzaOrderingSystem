@extends('layouts.admin.nav')
@section('main-content')
    <div class="col-md-12">
        @if (session('success'))
            <div class=" d-flex justify-content-end">
                <div class="alert alert-info text-center alert-dismissible fade show"  style="width: 30rem;" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <form class="form-header" action="{{ route('category#list') }}">
                        <input class="au-input au-input--xl" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search for category name..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-data__tool-right">
                <a href="{{ route('category#create') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add item
                    </button>
                </a>
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    CSV download
                </button>
            </div>
        </div>
        <div class="row justify-content-end">
            <h4 class="pr-4">Total-({{ $categories->total() }})</h4>
        </div>
    </div>

    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2 text-center">
            @if (count($categories) != 0)
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key=>$category)
                        <tr class="tr-shadow">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="zmdi zmdi-mail-send text-secondary"></i>
                                    </button>
                                    <a href="{{ route('category#edit', $category->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit text-primary"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('category#delete', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete text-danger"></i>
                                        </button>
                                    </form>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                        <i class="zmdi zmdi-more text-dark"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h1 class="text-center text-secondary p-5">There is any Pizza Category</h1>
            @endif


            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
    <!-- END DATA TABLE -->
    </div>
@endsection
