@extends('app')
@section('content')

    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab"> Talep Detayları </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <div class="col-md-12">
                            <strong>Açıklama:</strong>
                            <span>
                                @if(empty($cekilenTalep->aciklama))
                                    -
                                @else
                                    {{ $cekilenTalep->aciklama }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-12">
                            <strong>Onay:</strong>
                            <span>
                                @if(!empty($cekilenTalep->onay))
                                    @if( $cekilenTalep->onay == 0 )
                                        <label class="label label-danger">Onay Bekliyor</label>
                                    @elseif( $cekilenTalep->onay == 1 )
                                        <label class="label label-success">Onaylandı</label>
                                    @elseif( $cekilenTalep->onay == 2 )
                                        <label style="color: black" class="label label-warning"><i class="fa fa-truck"></i> &nbsp;Yolda</label>
                                    @elseif( $cekilenTalep->onay == 3 )
                                        <label class="label label-success"><i class="fa fa-check"></i> &nbsp;Tamamlandı</label>
                                    @endif
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="col-md-12">
                            <strong>Referans Tipi:</strong>
                            <span> {{ $cekilenTalep->referans_tipi }}</span>
                        </div>
                        <div class="col-md-12">
                            <strong>Kaynak:</strong>
                            <span> {{ $cekilenTalep->birim->ad }} - {{ $cekilenTalep->birim->birimTuru->ad }} </span>
                        </div>
                        <div class="col-md-12">
                            <strong>Hedef:</strong>
                            <span> {{ $cekilenTalep->calisanBirim->ad }} - {{ $cekilenTalep->calisanBirim->birimTuru->ad }}</span>
                        </div>
                        <div class="col-md-12">
                            <strong>Talep Oluşturulma Tarihi:</strong>
                            <span> {{ $cekilenTalep->created_at }}</span>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <strong>Talep Eden Çalışan Bilgileri:</strong>
                            <p>
                                <b>Ad ve Soyad:</b>
                                <span>{{ $cekilenTalep->calisan->name }} {{ $cekilenTalep->calisan->lastname }}</span>
                                <br>
                                <b>Email:</b>
                                <span> {{ $cekilenTalep->calisan->email  }}</span>
                                <br>
                                <b>Birim:</b>
                                <span> {{ $cekilenTalep->calisan->birim->ad  }} - {{ $cekilenTalep->calisan->birim->birimTuru->ad  }}</span>
                            </p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12">
                            <br><br>
                            <strong class="col-md-12"> Ürünler</strong>
                            <hr class="col-md-12">
                            @foreach($cekilenTalepDetay as $talepDetay)
                                <div class="col-xs-12 col-md-2">
                                    <strong>Ürün:</strong> <span>{{ $talepDetay->urun[0]->ad }}</span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <strong>Miktar:</strong> <span>{{ $talepDetay->urun_adet }}</span>
                                </div>
                                <div class=" col-md-1">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <strong>Ürün Birimi:</strong> <span>{{ $talepDetay->urunBirimi->ad }}</span>
                                </div>
                                <hr class="col-xs-12">
                            @endforeach
                        </div>
                        @if($cekilenTalep->onay == 2 && \Illuminate\Support\Facades\Auth::user()->birim_id == $cekilenTalep->calisanBirim->id )
                            <div>
                                <a class="btn btn-primary" href="/talepler/detay-talep/geldi/{{ $cekilenTalep->id }}"><i class="fa fa-check"></i> &nbsp;Geldi</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="clearfix margin-bottom-20"></div>
            </div>
        </div>
    </div>
    <div class="clearfix margin-bottom-20"></div>
@endsection

@section('css')

@endsection

@section('js')

@endsection