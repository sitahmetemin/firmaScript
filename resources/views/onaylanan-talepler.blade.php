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
                                                {{ ( isset($talep->birim->ad) ? $talep->birim->ad : 'Silinmiş') }} -
                                                <b>{{ ( isset($talep->birim->birimTuru->ad) ? $talep->birim->birimTuru->ad : 'Silinmiş')  }}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                <i class="fa fa-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                {{ ( isset($talep->calisanBirim->ad) ? $talep->calisanBirim->ad : 'Silinmiş') }} -
                                                <b>{{ ( isset($talep->calisanBirim->birimTuru->ad) ? $talep->calisanBirim->birimTuru->ad : 'Silinmiş') }} </b>
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
                                            <div class="col-md-3">
                                                <a class="btn blue btn-outline sbold" title="Yola Çıktı" data-toggle="modal" href="#responsive-{{ $talep->id }}"><i class="fa fa-truck"></i>&nbsp;Yola
                                                    Çıktı</a>
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

    @foreach($cekilenTalep as $talep)
        <div id="responsive-{{ $talep->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Yola Çıkış Bilgileri</h4>
                    </div>
                    <form action="/onaylanan-talepler/cikis-talep/{{$talep->id}}" method="get">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                                <div class="row">
                                    {{--<div class="col-md-6">--}}
                                        {{--<h4>Fatura No</h4>--}}
                                        {{--<p>--}}
                                            {{--<input type="text" name="fatura_no" class="col-md-12 form-control">--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <h4>İrsaliye No</h4>
                                        <p>
                                            <input type="text" name="irsaliye_no" class="col-md-12 form-control" required>
                                        </p>
                                        <input type="hidden" name="id" value="{{ $talep->id }}" class="col-md-12 form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn dark btn-outline">Kapat</button>
                            <button class="btn green"><i class="fa fa-truck"></i>&nbsp;Çıkış Yaptı</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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