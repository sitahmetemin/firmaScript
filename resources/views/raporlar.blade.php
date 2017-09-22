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
                                <div class="col-md-4">
                                    <div class="input-group" id="defaultrange">
                                        <input type="text" name="tarih" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default date-range-toggle" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn red">
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
    <link href="/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/backend/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script src="/backend/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
@endsection