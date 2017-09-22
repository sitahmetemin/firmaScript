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
                                    <input name="baslangicTarihi" class="col-md-12" type="date">
                                    <span class="help-block">Başlangıç Tarihi</span>
                                </div>
                                <div class="col-md-3">
                                    <input name="bitisTarihi" class="col-md-12" type="date">
                                    <span class="help-block">Bitiş Tarihi</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Raporlar</label>
                                <div class="col-md-6">
                                    <select name="rapor_id" class="form-control select2">
                                        <option></option>
                                        <option value="sdaf">denene</option>
                                    </select>
                                    <span class="help-block">Hangi Bölümden Rapor Almak İstediğinizi Seçin</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button id="rsporGetir" type="submit" class="btn red">
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

@endsection

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/backend/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -/backend
@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/backend/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/backend/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

@endsection