@extends('.app')
@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            <strong>Başarılı!</strong> İşleminiz Başarıyla Gerçeklştirldi
        </div>
    @elseif(session('hataStatus'))
        <div class="alert alert-danger">
            <strong>BAŞARISIZ!</strong> İşleminiz Gerçekleştirilemedi!
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-arrow-circle-down font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Onaylanan Talepler</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                <a href="/talepler/ekle-talep" class="toggle"><i class="fa fa-plus"></i>&nbsp;Ekle</a>
                            </label>
                        </div>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Dışarı Aktar </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                <li>
                                    <a href="javascript:;" data-action="0" class="tool-action">
                                        <i class="icon-printer"></i> Yazdır</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="1" class="tool-action">
                                        <i class="icon-check"></i> Kopyala</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="2" class="tool-action">
                                        <i class="icon-doc"></i> PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="3" class="tool-action">
                                        <i class="icon-paper-clip"></i> Excel</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="4" class="tool-action">
                                        <i class="icon-cloud-upload"></i> CSV</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:;" data-action="5" class="tool-action">
                                        <i class="icon-refresh"></i> Yeniden Şekillendir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th> #</th>
                                {{--<th> URUN(ADET)[BİRİM]</th>--}}
                                <th> AÇIKLAMA</th>
                                <th> NEREDEN <i class="fa fa-arrow-right"></i> NEREYE</th>
                                <th> TALEP EDEN ÇALIŞAN</th>
                                <th> TARİHİ</th>
                                <th> İŞLEMLER</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cekilenTalep as $talep)
                                <tr>
                                    <td> {{ $talep->id }}</td>
                                    <td> {{ $talep->aciklama }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                {{ $talep->birim->ad }} - <b>{{ $talep->birim->birimTuru->ad }}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                <i class="fa fa-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                {{$talep->calisanBirim->ad }} - <b>{{ $talep->calisanBirim->birimTuru->ad }} </b>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(empty($talep->calisan->name) || empty($talep->calisanBirim->ad))
                                            -
                                        @else
                                            {{ $talep->calisan->name }} <i class="fa fa-arrows-h"></i> {{ $talep->calisanBirim->ad }}
                                        @endif
                                    </td>
                                    <td> {{ substr($talep->updated_at, 0, 16) }}</td>
                                    <td>
                                        <div class="row col-md-12">
                                            <div class="col-md-3">
                                                <a href="/talepler/detay-talep/{{ $talep->id }}" title="Detaylar" class="btn btn-warning btn-sm"><i class="fa fa-search"></i></a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="/onaylanan-talepler/sil-talep/{{ $talep->id }}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
@endsection
@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/backend/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/backend/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/backend/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="/backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/backend/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection