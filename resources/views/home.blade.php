@extends('app')
@section('content')
    <div class="row">
        @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin')
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-university"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ $firmaAdet }}">0</span>
                        </div>
                        <div class="desc"> Firma</div>
                    </div>
                </a>
            </div>
        @endif
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-black-tie"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $musteriAdet }}">0</span></div>
                    <div class="desc"> Müşteri</div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $urunAdet }}">0</span>
                    </div>
                    <div class="desc"> Ürün</div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $calisanAdet }}"></span></div>
                    <div class="desc"> Çalışan</div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-align-left"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $kategoriAdet }}"></span></div>
                    <div class="desc"> Kategori</div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-table"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $birimAdet }}"></span></div>
                    <div class="desc"> Birim</div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $talepAdet }}">0</span>
                    </div>
                    <div class="desc"> Transfer <br>
                        <small>Bekleyen Ürün</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix">

        @endsection

        @section('css')

        @endsection

        @section('js')
            <script src="/backend/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="/backend/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
@endsection