@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Firma Ekle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Firma</label>
                                <div class="col-md-4">
                                    <input value="{{ $bulunanFirma->ad }}" name="ad" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Firma Adını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Telefon</label>
                                <div class="col-md-4">
                                    <input value="{{ $bulunanFirma->telefon }}" name="telefon" class="form-control" id="mask_date" required type="number"/>
                                    <span class="help-block"> Firmanın Telefon Numarasını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Fax</label>
                                <div class="col-md-4">
                                    <input value="{{ $bulunanFirma->fax }}" name="fax" class="form-control" id="mask_date" required type="number"/>
                                    <span class="help-block"> Firmanın Fax Numarasını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">E-mail</label>
                                <div class="col-md-4">
                                    <input value="{{ $bulunanFirma->email }}" name="email" class="form-control" id="mask_date" required type="email"/>
                                    <span class="help-block"> Firmanın e-mail adresinin yazınız Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Vergi No</label>
                                <div class="col-md-4">
                                    <input value="{{ $bulunanFirma->vergi_no }}" name="vergi_no" class="form-control" id="mask_date" required type="number"/>
                                    <span class="help-block"> Firmanın Verigi Numarasını Yazınız </span>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki === 'superAdmin')
                                <div class="form-group">
                                    <label class="control-label col-md-3">Durum</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="durum" id="single" class="form-control select2">
                                                <option></option>
                                                <optgroup label="Statü">
                                                    @if($bulunanFirma->durum == 1)
                                                        <option selected value="1">Aktif</option>
                                                        <option value="0">Pasif</option>
                                                    @else
                                                        <option value="1">Aktif</option>
                                                        <option selected value="0">Pasif</option>
                                                    @endif
                                                </optgroup>
                                            </select>
                                        </div>
                                        <span class="help-block"> Hangi Duruma Ait Olduğunu Seçiniz </span>
                                    </div>
                                </div>
                            @endif

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