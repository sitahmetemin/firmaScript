@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Çalışan Ekle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Ad</label>
                                <div class="col-md-4">
                                    <input name="name" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Çalışan Adını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Soyad</label>
                                <div class="col-md-4">
                                    <input name="lastname" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Çalışan Soyadını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Mail</label>
                                <div class="col-md-4">
                                    <input name="email" class="form-control" id="mask_date" required type="email"/>
                                    <span class="help-block"> Çalışan Mail Adresini Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Şifre</label>
                                <div class="col-md-4">
                                    <input name="password" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Çalışan Mail Şifresini Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">TC No</label>
                                <div class="col-md-4">
                                    <input name="tc_no" class="form-control" id="mask_date" required type="number"/>
                                    <span class="help-block"> Çalışan TC Kimlik Numarasını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Çalışan Birimi</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="birim_id" id="single" class="form-control select2">
                                                    <option></option>
                                                    <optgroup label="Birimler">
                                                        @foreach($cekilenBirimler as $birim)
                                                            <option value="{{ $birim->id }}"> {{ $birim->ad . ' => ' . $birim->birimTuru->ad}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"> Çalışan Hangi Birimde Çalıştığını </span>
                                </div>
                            </div>
                            @if( \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' )
                            <div class="form-group">
                                <label class="control-label col-md-3">Çalışan Firması</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="firma_id" id="single" class="form-control select2">
                                                    <option></option>
                                                    <optgroup label="Birimler">
                                                        @foreach($cekilenFirmalar as $firma)
                                                            <option value="{{ $firma->id }}"> {{ $firma->ad}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"> Çalışanın Hangi Firmada Çalıştığını Seçiniz </span>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-md-3">Çalışan Yetki Grubu</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="yetki" id="yetkiControl" class="form-control select2">
                                                    <optgroup label="Birimler">
                                                        @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin')
                                                            <option value="superAdmin">Süper Admin</option>
                                                        @endif
                                                        <option value="admin">Yönetici</option>
                                                        <option value="personel">Personel</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"> Çalışan Hangi Birimde Çalıştığını </span>
                                </div>
                            </div>
                            <div id="yetkiKutusu" class="form-group">
                                <label class="control-label col-md-3">Çalışanın ulaşmasını istediğiniz sayfalar</label>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <input name="birim" type="checkbox" class="make-switch">
                                            <span class="help-block">Birim</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="birimTuru" type="checkbox" class="make-switch">
                                            <span class="help-block">Birim Türü</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="urun" type="checkbox" class="make-switch">
                                            <span class="help-block">Ürün</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="urunBirimi" type="checkbox" class="make-switch">
                                            <span class="help-block">Ürün Birim</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="urunKategorisi" type="checkbox" class="make-switch">
                                            <span class="help-block">Ürün Kategori</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="talep" type="checkbox" class="make-switch">
                                            <span class="help-block">Talep</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="musteri" type="checkbox" class="make-switch">
                                            <span class="help-block">Müşteri</span>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="proje" type="checkbox" class="make-switch">
                                            <span class="help-block">Proje</span>
                                        </div>
                                    </div>
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

    <script>
        $(function () {
            $('#yetkiKutusu').slideUp();

            $('#yetkiControl').change(function () {
                var yetki = $('#yetkiControl option:selected').val();
                if (yetki == 'personel') {
                    $('#yetkiKutusu').slideDown(500);
                }
                else {
                    $('#yetkiKutusu').slideUp(500);
                }
            });
        });
    </script>
@endsection