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
                        <i class="fa fa-gavel font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Ürünler</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                <a href="/urunler/ekle-urun" class="toggle"><i class="fa fa-plus"></i>&nbsp;Ekle</a>
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
                                <th> İSİM</th>
                                <th> AÇIKLAMA</th>
                                <th> BİRİM</th>
                                <th> KATEGORİ</th>
                                <th> DURUM</th>
                                <th> DÜZENLEME TARİHİ</th>
                                <th> İŞLEMLER</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cekilenUrunler as $urun)
                                <tr>
                                    <td> {{ $urun->id }}</td>
                                    <td> {{ $urun->ad }}</td>
                                    <td> {{ substr($urun->aciklama, 0, 25) }}...</td>
                                    <td> {{ (isset($urun->urunBirimi->ad) ? $urun->urunBirimi->ad : 'Silinmiş') }}</td>
                                    <td> {{ (isset($urun->urunKategorisi->ad) ? $urun->urunKategorisi->ad : 'Silinmiş') }}</td>
                                    <td>
                                        @if($urun->durum)
                                            <label class="label label-primary"><i class="fa fa-eye"></i>&nbsp; Aktif</label>
                                        @else
                                            <label class="label label-danger"><i class="fa fa-eye-slash"></i> &nbsp; Pasif</label>
                                        @endif
                                    </td>
                                    <td> {{ $urun->updated_at }}</td>
                                    <td>
                                        <a href="/urunler/guncelle-urun/{{ $urun->id }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>&nbsp;/ &nbsp;
                                        <a href="/urunler/sil-urun/{{ $urun->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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