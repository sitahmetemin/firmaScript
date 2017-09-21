@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Ürün Ekle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Kategori</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <select name="kategori_id" id="single" class="form-control select2">
                                                    <option></option>
                                                    <optgroup label="Ürün Kategorileri">
                                                        @foreach($kategoriler as $kategori)
                                                            <option value="{{ $kategori->id }}">{{ $kategori->ad }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="/ekle-urun-kategori" class="btn btn-primary"><i class="fa fa-arrow-circle-o-right"></i> Kategorilere Git</a>
                                        </div>
                                    </div>
                                    <span class="help-block"> Hangi Kategoriye Ait Olduğunu Seçiniz </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ürün Birimleri</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <select name="birim_id" id="single" class="form-control select2">
                                                    <option></option>
                                                    <optgroup label="Ürün Birimleri">
                                                        @foreach($cekilenBirimler as $birim)
                                                            <option value="{{ $birim->id }}">{{ $birim->ad }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="/ekle-urun-birimleri" class="btn btn-primary"><i class="fa fa-arrow-circle-o-right"></i> Ürün Birimlerine Git</a>
                                        </div>
                                    </div>
                                    <span class="help-block"> Hangi Kategoriye Ait Olduğunu Seçiniz </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ürün</label>
                                <div class="col-md-4">
                                    <input name="ad" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Ürün Adını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Açıklama</label>
                                <div class="col-md-4">
                                    <textarea name="aciklama" class="form-control" rows="3"></textarea>
                                    <span class="help-block"> Ürün Açıklama Yazınız </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Durum</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="durum" id="single" class="form-control select2">
                                            <option></option>
                                            <optgroup label="Statü">
                                                <option selected value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <span class="help-block"> Hangi Duruma Ait Olduğunu Seçiniz </span>
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