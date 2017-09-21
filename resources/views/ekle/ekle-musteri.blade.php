@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-user-follow font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Müşteri Ekle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Ünvan</label>
                                <div class="col-md-4">
                                    <input name="unvan" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Müşteri Ünvanını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Yetkili</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="yetkili_id" class="form-control select2">
                                            <option></option>
                                            <optgroup label="Firma Yetkilisi">
                                                @foreach($cekilenYetkililer as $yetkili)
                                                    <option value="{{ $yetkili->id }}"> {{ $yetkili->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <span class="help-block"> Müşterinin Hangi Yetkiliye Ait Olduğunu Seçiniz </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Telefon</label>
                                <div class="col-md-4">
                                    <input name="telefon" class="form-control" id="mask_date" type="number"/>
                                    <span class="help-block"> Müşteri Telefonunu Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-4">
                                    <input name="email" class="form-control" id="mask_date" required type="email"/>
                                    <span class="help-block">  Müşteri Email Adresini Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Adres</label>
                                <div class="col-md-4">
                                    <input name="adres" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Adresinizi Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">İl</label>
                                <div class="col-md-4">
                                    <input name="il" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block">İl Yazınız </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple">
                                        <i class="fa fa-check"></i> Ekle
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