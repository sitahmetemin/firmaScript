@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-print"></i>Rapor Sistemi
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Raporunu Almak İstediğiniz Tarih Aralığını Seçin</label>
                                <div class="col-md-3">
                                    <input required name="baslangicTarihi" id="baslangicTarihi" value="{{ isset($alinanBaslangic) }}" class="col-md-12" type="date">
                                    <span class="help-block">Başlangıç Tarihi</span>
                                </div>
                                <div class="col-md-3">
                                    <input required name="bitisTarihi" id="bitisTarihi" value="{{ isset($alinanBitis) }}" class="col-md-12" type="date">
                                    <span class="help-block">Bitiş Tarihi</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Raporlar</label>
                                <div class="col-md-6">
                                    <select name="rapor_turu" class="form-control select2">
                                        <option></option>
                                        @if(isset($alinanRaporTuru))
                                            @if($alinanRaporTuru == 'talep')
                                                <option value="proje">Proje</option>
                                                <option selected value="talep">Talep</option>
                                            @else
                                                <option selected value="proje">Proje</option>
                                                <option value="talep">Talep</option>
                                            @endif
                                        @else
                                            <option value="proje">Proje</option>
                                            <option value="talep">Talep</option>
                                        @endif
                                    </select>
                                    <span class="help-block">Hangi Bölümden Rapor Almak İstediğinizi Seçin</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Birim</label>
                                <div class="col-md-6">
                                    <select name="birim_id" class="form-control select2">
                                        <option></option>
                                        <option value="tumu">Tümü</option>
                                        @if(isset($cekilenBirim))
                                            @foreach($cekilenBirim as $birim)
                                                @if(isset($alinanBirim_id) == $birim->id)
                                                    <option selected value="{{ $birim->id }}">{{ $birim->ad . ' - ' . $birim->birimTuru->ad }} </option>
                                                @else
                                                    <option value="{{ $birim->id }}">{{ $birim->ad . ' - ' . $birim->birimTuru->ad }} </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block">Listelemek istediğiniz birimi seçin</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button id="raporGetir" type="submit" class="btn red">
                                        <i class="fa fa-list"></i> Listele
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gavel font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Rapor İçeriği</span>
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
                                <th> REFERANS TİPİ</th>
                                <th> URUN</th>
                                <th> URUN MİKTAR</th>
                                <th> URUN BİRİMİ</th>
                                <th> BİRİM</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($cekilenHareketler))
                                @foreach($cekilenHareketler as $hareket)
                                    <tr>
                                        <td> {{ $hareket->id }}</td>
                                        <td> {{ $hareket->referans_tipi }}</td>
                                        <td> {{ $hareket->urun->ad }}</td>
                                        <td> {{ $hareket->urun_miktar }}</td>
                                        <td> {{ $hareket->urun->urunBirimi->ad }}</td>
                                        @if($hareket->hareket_yonu == 0)
                                            <td> {{ $hareket->referans->ad }} <i class="fa fa-arrow-right"></i> {{ $hareket->birim->ad  }}</td>
                                        @else
                                            <td> {{ $hareket->referans->ad }} <i class="fa fa-arrow-left"></i> {{ $hareket->birim->ad  }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
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
    <link href="/backend/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -/backend

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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/backend/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/backend/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        $(function () {
            var tarih = new Date();
            $('#bitisTarihiTarihi').val(tarih.getDate());
        });
    </script>

@endsection