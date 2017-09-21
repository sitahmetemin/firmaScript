@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-plus font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Birim Güncelle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{csrf_field()}}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birim</label>
                                <div class="col-md-4">
                                    <input name="ad" class="form-control" id="mask_date" type="text" value="{{ $bulunanBirim->ad }}"/>
                                    <span class="help-block"> Birim Adını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Adres</label>
                                <div class="col-md-4">
                                    <input name="adres" class="form-control" id="mask_date" type="text" value="{{ $bulunanBirim->adres }}"/>
                                    <span class="help-block"> Adresinizi Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">İl</label>
                                <div class="col-md-4">
                                    <input name="il" class="form-control" id="mask_date" type="text" value="{{ $bulunanBirim->il }}"/>
                                    <span class="help-block"> İl Adını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Tür</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="tur_id" class="form-control select2">
                                            <option></option>
                                            <optgroup label="Birim Türü">
                                                @foreach($cekilenBirimTuru as $tur)
                                                    @if($bulunanBirim->tur_id == $tur->id)
                                                        <option selected value="{{ $tur->id }}"> {{ $tur->ad }}</option>
                                                    @else
                                                    <option value="{{ $tur->id }}"> {{ $tur->ad }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <span class="help-block"> Hangi Türe Ait Olduğunu Seçiniz </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple">
                                        <i class="fa fa-check"></i> Kaydet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
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