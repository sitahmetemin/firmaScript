<?php

namespace App\Http\Controllers;

use App\Birim;
use App\BirimTuru;
use App\Firma;
use App\Musteri;
use App\Talep;
use App\Urun;
use App\UrunBirim;
use App\UrunKategori;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends AdminController
{
    //-----------------------------------------------------------------------Ekleme İşlemleri
    public function postFirmaEkle(Request $request)
    {
        $add = Firma::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('firmalar')->with('status', $status);
        }

        $hataStatus = 'İşlem Başarısız!!';
        return redirect('firmalar')->with('hataStatus', $hataStatus);
    }

    public function postUrunEkle(Request $request)
    {

        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = Urun::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('urunler')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('urunler')->with('hataStatus', $hataStatus);
    }

    public function postBirimEkle(Request $request)
    {

        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = Birim::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('birimler')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('birimler')->with('hataStatus', $hataStatus);
    }

    public function postBirimTuruEkle(Request $request)
    {
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = BirimTuru::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('ekle-birim-turu')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('ekle-birim-turu')->with('hataStatus', $hataStatus);

    }

    public function postUrunKategoriEkle(Request $request)
    {
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = UrunKategori::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('ekle-urun-kategori')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('ekle-urun-kategori')->with('hataStatus', $hataStatus);

    }

    public function postUrunBirimleriEkle(Request $request)
    {
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = UrunBirim::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('ekle-urun-birimleri')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('ekle-urun-birimleri')->with('hataStatus', $hataStatus);

    }

    public function postMusteriEkle(Request $request)
    {
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = Musteri::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('musteriler')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('musteriler')->with('hataStatus', $hataStatus);

    }

    public function postCalisanEkle(Request $request)
    {
        $pass = bcrypt($request->password);
        $request->except('password');
        $request->merge(['password' => $pass]);
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $add = User::create($request->all());
        if ($add) {
            $status = 'İşlem Başarılı';
            return redirect('calisanlar')->with('status', $status);
        }
        $hataStatus = 'İşlem Başarısız!!';
        return redirect('calisanlar')->with('hataStatus', $hataStatus);

    }

    public function postTalepEkle(Request $request)
    {
        $request->merge(['firma_id' => Auth::user()->firma_id]);
        $request->merge(['talep_eden_birim_id' => Auth::user()->birim_id]);
        $request->merge(['talep_eden_calisan_id' => Auth::user()->id]);
        $request->merge(['onay' => 0]);

        $talepEkle = Talep::create($request->only('onay', 'aciklama', 'referans_tipi', 'birim_id', 'talep_eden_calisan_id', 'talep_eden_birim_id', 'firma_id'));
        if ($talepEkle) {
            $talepEkle->talepDetaylari()->createMany($request->only('urunler')['urunler']);
            $status = 'İşlem Başarılı';
            return redirect('talepler')->with('status', $status);
        }

        $hataStatus = 'İşlem Başarısız!!';
        return redirect('talepler')->with('hataStatus', $hataStatus);
    }

    //-----------------------------------------------------------------------------------------Ekleme İşlemleri Bitiş

    //-----------------------------------------------------------------------------------------Güncelleme İşlemleri

    public function postGuncelleBirim(Request $request, $id)
    {
        $update = Birim::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('birimler')->with('status', $statu);
        }

        $statu = 'İşlem Başarısız';
        return redirect('birimler')->with('status', $statu);
    }

    public function postGuncelleBirimTuru(Request $request, $id)
    {
        $update = BirimTuru::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('ekle-birim-turu')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('ekle-birim-turu')->with('status', $statu);
    }

    public function postGuncelleCalisan(Request $request, $id)
    {
        $update = User::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('calisanlar')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('calisanlar')->with('status', $statu);
    }

    public function postGuncelleFirma(Request $request, $id)
    {
        $update = Firma::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('firmalar')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('firmalar')->with('status', $statu);
    }

    public function postGuncelleMusteri(Request $request, $id)
    {
        $update = Musteri::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('musteriler')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('musteriler')->with('status', $statu);
    }

    public function postGuncelleUrun(Request $request, $id)
    {
        $update = Urun::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('urunler')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('urunler')->with('status', $statu);
    }

    public function postGuncelleUrunKategori(Request $request, $id)
    {
        $update = UrunKategori::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('ekle-urun-kategori')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('ekle-urun-kategori')->with('status', $statu);
    }

    public function postGuncelleUrunBirim(Request $request, $id)
    {
        $update = UrunBirim::find($id)->update($request->all());
        if ($update) {
            $statu = 'İşlem Başarılı';
            return redirect('ekle-urun-birimleri')->with('status', $statu);
        }

        $statu = 'İşlem BAŞARISIZ!';
        return redirect('ekle-urun-birimleri')->with('status', $statu);
    }

//-----------------------------------------------------------------------------------------Güncelleme İşlemleri Bitiş

//-----------------------------------------------------------------------------------------Raporlama
    public function raporla(Request $request)
    {

    }

}
