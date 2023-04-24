@extends('layouts.admin.nav')
@section('main-content')
    <div class="col-md-12">
        <!-- DATA TABLE -->
        {{-- <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <form class="form-header" action="{{ route('contact#list') }}">
                        <input class="au-input au-input--xl" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search for contact name..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="row justify-content-end">
            <h4 class="pr-4">Total-({{ $contacts->total() }})</h4>
        </div>
    </div>

    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2 text-center">
            @if (count($contacts) != 0)
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Message</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key=>$contact)
                        <tr class="tr-shadow">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $contact->user->name }}</td>
                            <td>{{ $contact->message }}</td>

                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h1 class="text-center text-secondary p-5">There is any Pizza Category</h1>
            @endif


            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
    <!-- END DATA TABLE -->
    </div>
@endsection
