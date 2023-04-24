@extends('layouts.admin.nav')
@section('main-content')
    <div class="col-md-12">
        @if (session('success'))
            <div class=" d-flex justify-content-center">
                <div class="alert alert-success text-center alert-dismissible fade show" style="width: 75%;" role="alert">
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
                    <h2 class="title-1">Customer List</h2>
                </div>
            </div>
            <div class="table-data__tool-right">
                <a href="{{ route('user#delete#list') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                    Deleted Users
                </a>
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    CSV download
                </button>
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
                        <th>date</th>
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
                                <form style="width: 120px;" action="{{ route('change#role', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="d-flex">
                                        <div class="">
                                            <select class="user-role form-control" name="role" id="">
                                                <option class=" block-email" value="admin"
                                                    {{ $user->role == 'admin' ? 'selected' : ' ' }}>
                                                    Admin</option>
                                                <option class=" block-email" value="user"
                                                    {{ $user->role == 'user' ? 'selected' : ' ' }}>
                                                    User</option>
                                            </select>
                                        </div>
                                        {{-- <div class="">
                                            <button class="btn form-control inline-block mt-2 float-left" type="submit"><i
                                                    class="fa-solid fa-arrow-up fa-lg" style="color: #295d94;"></i>
                                            </button>
                                        </div> --}}
                                    </div>
                                </form>
                            </td>
                            <input type="hidden" name="" class="userId" value="{{ $user->id }}">

                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="zmdi zmdi-mail-send text-secondary"></i>
                                    </button>
                                    @if (Auth::user()->id != $user->id)
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="{{ route('user#delete',$user->id) }}">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </a>
                                        </button>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    {{-- <tr class="tr-shadow">

                        <td>Lori Lynch</td>
                        <td>
                            <span class="block-email">john@example.com</span>
                        </td>
                        <td class="desc">iPhone X 64Gb Grey</td>
                        <td>2018-09-29 05:57</td>
                        <td>
                            <span class="status--process">Processed</span>
                        </td>
                        <td>$999.00</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">

                        <td>Lori Lynch</td>
                        <td>
                            <span class="block-email">lyn@example.com</span>
                        </td>
                        <td class="desc">iPhone X 256Gb Black</td>
                        <td>2018-09-25 19:03</td>
                        <td>
                            <span class="status--denied">Denied</span>
                        </td>
                        <td>$1199.00</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">

                        <td>Lori Lynch</td>
                        <td>
                            <span class="block-email">doe@example.com</span>
                        </td>
                        <td class="desc">Camera C430W 4k</td>
                        <td>2018-09-24 19:10</td>
                        <td>
                            <span class="status--process">Processed</span>
                        </td>
                        <td>$699.00</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {

            $('.user-role').change(function() {
                $parentNode = $(this).parents("tr");
                $userRole = $parentNode.find('.user-role').val();
                $userId = $parentNode.find('.userId').val();

                console.log($userId);

                $.ajax({
                    type: 'get',
                    url: '/dashboard/customers/change-role',
                    dataType: 'json',
                    data: {
                        userId : $userId,
                        role: $userRole,
                    },
                    success: function(response) {
                        console.log(response);
                        // location.reload();
                    }
                })

            })

        })
    </script>
@endsection
