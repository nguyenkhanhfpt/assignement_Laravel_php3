@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor my-2">Quản lý</h4>
        </div>
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="far fa-tshirt"></i></h3>
                                <p class="text-muted">TỔNG SỐ SẢN PHẨM</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-primary">{{ $countProduct }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="far fa-cart-plus"></i></h3>
                                <p class="text-muted">TỔNG SỐ ĐƠN HÀNG</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-cyan">{{ $countBill }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="far fa-newspaper"></i></h3>
                                <p class="text-muted">TỔNG SỐ BÀI VIẾT</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-purple">{{ $countNews }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="far fa-comments"></i></h3>
                                <p class="text-muted">TỔNG SỐ BÌNH LUẬN</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-success">{{ $countComment }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-40 align-items-center no-block">
                        <h5 class="card-title ">THỐNG KÊ TỔNG SỐ ĐƠN HÀNG TRONG 7 NGÀY GẦN NHẤT</h5>
                        <div class="ml-auto">
                            <ul class="list-inline font-12">
                                <li><i class="fa fa-circle text-cyan"></i> Đơn hàng</li>
                            </ul>
                        </div>
                    </div>
                    <div id="morris-area-chart2" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Một số bình luận</h5>
                    <h6 class="card-subtitle">5 bình luận mới nhất</h6>
                </div>
                <div class="comment-widgets" id="comment" style="max-height: 600px;position: relative;">
                    @foreach($comments as $comment)
                    <div class="d-flex no-block comment-row">
                        <div class="p-2">
                            <span class="round">
                                <img src="{{ asset('images') }}/{{ $comment->member->img_member }}" alt="user" width="50">
                            </span>
                        </div>
                        <div class="comment-text w-100">
                            <h5 class="font-medium">{{ $comment->member->name_member }}</h5>
                            <p class="m-b-10 text-muted">{{ $comment->content }}</p>
                            <div class="comment-footer">
                                <span class="text-muted pull-right">{{ $comment->date_comment }}</span> 
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Một số đơn hàng mới</h5>
                            <h6 class="card-subtitle">10 đơn hàng gần đây nhất</h6>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>TÊN NGƯỜI MUA</th>
                                <th>TRẠNG THÁI</th>
                                <th>THỜI GIAN</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $num = 0; ?>
                            @foreach($bills as $bill)
                                <tr>
                                    <td class="text-center">{{ ++$num }}</td>
                                    <td class="txt-oflo">{{ $bill->member->name_member }}</td>
                                    <td>
                                        @if ($bill->status == config('settings.rejected'))
                                            <span class='badge badge-pill badge-danger'>Đã hủy</span>
                                        @elseif ($bill->status == config('settings.accepted'))
                                            <span class='badge badge-pill badge-success'>Đã hoàn thành</span>
                                        @elseif ($bill->status == config('settings.running'))
                                            <span class='badge badge-pill badge-warning'>Đang giao</span>
                                        @else
                                            <span class='badge badge-pill badge-info'>Đang chờ</span>
                                        @endif
                                    </td>
                                    <td class="txt-oflo">
                                        {{ Carbon\Carbon::parse($bill->date_buy)->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if ($bill->status == config('settings.rejected'))
                                            <span class="text-danger">{{ $bill->total }}</span>
                                        @elseif ($bill->status == config('settings.accepted'))
                                            <span class="text-success">{{ $bill->total }}</span>
                                        @elseif ($bill->status == config('settings.running'))
                                            <span class="text-warning">{{ $bill->total }}</span>
                                        @else
                                            <span class="text-info">{{ $bill->total }}</span>
                                        @endif  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin') }}/chart.js"></script>

@endsection