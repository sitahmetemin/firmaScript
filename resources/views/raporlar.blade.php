@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Talep Ekle</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3">Ürün Kategori</label>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="kategoriList" id="kategoriList" class="form-control" multiple="multiple">
                                                        @foreach($cekilenUrunKategori as $urunKategori)
                                                            <option value="{{ $urunKategori->id }}">{{ $urunKategori->ad }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="help-block"> Ürün Kategorisini Seçiniz </span>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select id="urunler" class="form-control" multiple>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="help-block"> Hangi Ürünü Talep Ettiğnizi Seçiniz </span>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-10">
                                            <input class="form-control" id="miktar" required type="text"/>
                                            <span class="help-block"> Ürünün Miktarını Yazınız </span>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="" id="urunKutuEkle" class="btn btn-primary"><i class="fa fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Açıklama</label>
                                <div class="col-md-6">
                                    <input name="aciklama" class="form-control" id="mask_date" required type="text"/>
                                    <span class="help-block"> Talep Açıklamasını Yazınız </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Talep Edilen Birim</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="birim_id" id="single" class="form-control select2">
                                                    <option></option>
                                                    <optgroup label="Ürün Birimleri">
                                                        @foreach($cekilenBirimler as $birim)
                                                            <option value="{{ $birim->id }}">{{ $birim->ad }} => {{ $birim->birimTuru->ad }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"> Hangi Birimden Talep Ettiğinizi Seçiniz </span>
                                </div>
                            </div>
                            <input type="hidden" value="ürün" name="referans_tipi">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption"><i class="fa fa-check"></i>Talep Edilen Ürünler</div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable">
                                            <table name="ListItem" class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th> Kategorisi</th>
                                                    <th> Ürün Adı</th>
                                                    <th> Miktar</th>
                                                    <th> Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody id="UrunKutusu">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SAMPLE TABLE PORTLET-->
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
        $('#kategoriList').on('change', function (e) {
            var kategori_id = e.target.value;
            $.get('/talepler/ekle-talep/ajaxKategoriUrunleri/' + kategori_id, function (data) {
                $('#urunler').empty();
                $.each(data, function (talep_urunler, urunler) {
                    $('#urunler').append('<option value="' + urunler.id + '">' + urunler.ad + ' </option> ');
                });
            });
        });
    </script>

    <script>
        $(window).load(function () {

            $(function () {

                var scntDiv = $('#UrunKutusu');
                var i = $('#UrunKutusu').size() + 1;

                $("#urunKutuEkle").on('click', function () {

                    var kategori = [];
                    var urun = [];
                    var urunID = [];
                    var miktar = $('input[id=miktar]').val();


                    var kateforiDegisim = $('#kategoriList option:selected').change();
                    if (kateforiDegisim.index() >= 0) {

                        $("#kategoriList option:selected").each(function (index, element) {

                            var urunDegisim = $('#urunler option:selected').change();
                            if (urunDegisim.index() >= 0) {

                                kategori.push($(this).text());

                                $("#urunler option:selected").each(function (index, element) {
                                    urun.push($(this).text());
                                    urunID.push($(this).val());
                                    if (miktar.length > 0) {

                                        var urunBirimi = [];
                                        $.get('/talepler/ekle-talep/ajaxKategoriUrunleBirimleri/' + urunID, function (veri) {
                                            $.each(veri, function (talep_urunler, urunBirimleri) {


                                                $('<tr id="UrunKutusu">\n' +
                                                    '<td> ' + i + '</td>\n' +
                                                    '<td> ' + kategori + ' </td>\n' +
                                                    '<td> <input type="hidden" name="urunler[' + (i - 1) + '][urun_id]" value="' + urunID + '"><input type="hidden" name="urunler[' + (i - 1) + '][urun_birim_id]" value="' + urunBirimleri.birim_id + '" > ' + urun + '</td>\n' +
                                                    '<td> <input type="hidden" name="urunler[' + (i - 1) + '][urun_adet]" value="' + miktar + '"> ' + miktar + ' </td>\n' +
                                                    '<td>\n' +
                                                    '<a href="#" id="urunKutuSil" class="btn btn-sm btn-danger"> <i class="fa fa-minus-circle"></i> </a>\n' +
                                                    '</td>\n' +
                                                    '</tr>').appendTo(scntDiv);
                                                i++;

                                            });
                                        });

                                    }
                                    else {
                                        alert('Lütfen Miktar Giriiz');
                                    }
                                });
                            }
                            else {
                                alert('Lütfen Ürün Seçiniz');
                            }
                        });


                    }
                    else {
                        alert('Lütfen Kategori Seçiniz');
                    }

                    return false;
                });

                $(document).on('click', '#urunKutuSil', function () {
                    if (i > 2) {
                        $(this).parents('tr').remove();
                        i--;
                    }
                    return false;
                });

            });

        });

    </script>

@endsection