@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Danh sách thành viên</h2>

    <div class="box">
        <div class="table-responsive">
            <table class="table table_member">
                <thead>
                    <tr>
                        <th scope="col">Thành viên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td scope="row">
                                <img src="{{asset('images')}}/{{$member->img_member}}" alt="">
                                {{ $member->name_member }}
                            </td>
                            <td>
                                {{ $member->email }}
                            </td>
                            <td>
                                {{ $member->phone_number }}                                                                                                                                                                   
                            </td>
                            <td>
                                {{ $member->address }}
                            </td>
                            <td>
                                {{ $member->gender }}
                            </td>
                            <td>
                                @if($member->status_member == 1)
                                    <input class="checkbox-member switch" type="checkbox" checked value="{{$member->id_member}}" >
                                @else
                                    <input class="checkbox-member switch" type="checkbox" value="{{$member->id_member}}" >
                                @endif
                            </td>
                            <td>
                                <a href="{{route('adminMember')}}/{{$member->id_member}}" 
                                data-toggle="tooltip" data-placement="top" title="Chi tiết">
                                    <i class="fal fa-edit"></i>
                                </a>
                                <a onClick="return confirm('Bạn có muốn xóa thành viên này!')" 
                                href="{{route('adminMember')}}/delete/{{$member->id_member}}" 
                                data-toggle="tooltip" data-placement="top" title="Xóa">
                                    <i class="fal fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $('.checkbox-member').on('change', function() {
            let notChecks = $(".checkbox-member:not(:checked)");
            let checks = $(".checkbox-member:checked");

            for(var i=0; i < notChecks.length; i++){ 
                $.ajax({
                    type: "GET",
                    url: "/admin/members/notCheck/" +$(notChecks[i]).val()
                });
            };

            for(var i=0; i < checks.length; i++){
                $.ajax({
                    type: "GET",
                    url: "/admin/members/checked/" +$(checks[i]).val()
                });
            };
        });
    </script>

@endsection