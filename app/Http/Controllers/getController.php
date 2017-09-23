<?php

namespace App\Http\Controllers;

use App\Birim;
use App\BirimTuru;
use App\Firma;
use App\Musteri;
use App\Proje;
use App\Talep;
use App\TalepDetay;
use App\Urun;
use App\UrunBirim;
use App\UrunKategori;
use App\User;
use Illuminate\Support\Facades\Auth;

class getController extends AdminController
{
    //------------------------------------------------------------Listeleme Sayfaları
    public function getirHome()
    {
        return view('home', [
            'firmaAdet' => Firma::count(),
            'calisanAdet' => User::where('firma_id', Auth::user()->firma_id)->count(),
            'urunAdet' => Urun::where('firma_id', Auth::user()->firma_id)->count(),
            'musteriAdet' => Musteri::where('firma_id', Auth::user()->firma_id)->count(),
            'kategoriAdet' => UrunKategori::where('firma_id', Auth::user()->firma_id)->count(),
            'birimAdet' => Birim::where('firma_id', Auth::user()->firma_id)->count(),
            'talepAdet' => Talep::where('firma_id', Auth::user()->firma_id)->where('onay', 0)->count(),
        ]);
    }

    public function getirFirmalar()
    {
        return view('firmalar', [
            'cekilenFirmalar' => Firma::all(),
        ]);
    }

    public function getirLogin()
    {
        return view('login');
    }

    public function getirBirimler()
    {
        return view('birimler', [
            'cekilenBirimler' => Birim::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleBirimTuru()
    {
        return view('ekle.ekle-birim-turu', [
            'cekilenBirimTurleri' => BirimTuru::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirCalisanlar()
    {
        return view('calisanlar', [
            'cekilenCalisanlar' => User::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirMusteriler()
    {
        return view('musteriler', [
            'cekilenMusteriler' => Musteri::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirUrunler()
    {
        return view('urunler', [
            'cekilenUrunler' => Urun::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirUrunBirimleri()
    {
        return view('ekle.ekle-urun-birimleri', [
            'cekilenUrunBirimleri' => UrunBirim::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirTalepler()
    {
        return view('talepler', [
            'cekilenTalepler' => Talep::where('firma_id', Auth::user()->firma_id)->where('onay',0)->get(),
            'cekilenUrunler' => Urun::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirTalepDetay($id)
    {
        return view('detay-talep', [
            'cekilenTalep' => Talep::find($id),
            'cekilenTalepDetay' => TalepDetay::where('talep_id', $id)->get(),
        ]);
    }

    public function getirOnaylananTalepler()
    {
        return view('onaylanan-talepler', [
            'cekilenTalep' => Talep::where('firma_id', Auth::user()->firma_id)->where('onay', 1)->get(),
        ]);
    }

    public function getirRaporlar()
    {
        return view('raporlar');
    }

    public function getirEkleProje()
    {
        return view('ekle.ekle-proje', [
            'cekilenProjeler' => Proje::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenMusteriler' => Musteri::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }


    //------------------------------------------------------------Listeleme Sayfaları BİTİŞ


    //-------------------------------------------------------Ekleme sayfaları
    public function getirEkleBirim()
    {
        return view('ekle.ekle-birim', [
            'cekilenTurler' => BirimTuru::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleFirma()
    {
        return view('ekle.ekle-firma');
    }

    public function getirEkleCalisan()
    {
        return view('ekle.ekle-calisan', [
            'cekilenBirimler' => Birim::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenBirimTurleri' => BirimTuru::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleMusteri()
    {
        return view('ekle.ekle-musteri',[
            'cekilenYetkililer' => User::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleUrun()
    {
        return view('ekle.ekle-urun', [
            'kategoriler' => UrunKategori::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenBirimler' => UrunBirim::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleUrunKategori()
    {
        return view('ekle.ekle-urun-kategori', [
            'urunKategorileri' => UrunKategori::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function getirEkleTalep()
    {
        return view('ekle.ekle-talep', [
            'cekilenUrunBirimleri' => UrunBirim::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenBirimler' => Birim::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenUrunKategori' => UrunKategori::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function talepKategoriUrunu($id){
        $urunler = Urun::where('kategori_id', $id)->get();
        return response()->json($urunler);
    }

    public function talepUrunBirimi($id){
        $birimler = Urun::where('id',$id)->get();
        return response()->json($birimler);
    }

    //-------------------------------------------------------Ekleme sayfaları BİTİŞ

    //-----------------------------------------------------------------Silme Metodları
    public function silCalisan($id)
    {
        $delete = User::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('calisanlar')->with('status', $statu);
    }

    public function silBirim($id)
    {
        $delete = Birim::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('birimler')->with('status', $statu);
    }

    public function silFirma($id)
    {
        $delete = Firma::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('firmalar')->with('status', $statu);
    }

    public function silMusteri($id)
    {
        $delete = Musteri::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('musteriler')->with('status', $statu);
    }

    public function silUrun($id)
    {
        $delete = Urun::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('urunler')->with('status', $statu);
    }

    public function silUrunKategori($id)
    {
        $delete = UrunKategori::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-urun-kategori')->with('status', $statu);
    }

    public function silUrunBirim($id)
    {
        $delete = UrunBirim::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-urun-birimleri')->with('status', $statu);
    }

    public function silBirimTuru($id)
    {
        $delete = BirimTuru::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-birim-turu')->with('status', $statu);
    }

    public function silTalep($id)
    {
        $delete = Talep::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('talepler')->with('status', $statu);
    }

    public function silOnaylananTalep($id)
    {
        $delete = Talep::find($id);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('onaylanan-talepler')->with('status', $statu);
    }

    //-----------------------------------------------------------------Silme Metodları BİTİŞ

    //-----------------------------------------------------------------------Güncelle Sayfaları
    public function guncelleBirim($id)
    {
        return view('guncelle.guncelle-birim', [
            'bulunanBirim' => Birim::find($id),
            'cekilenBirimTuru' => BirimTuru::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function guncelleBirimTuru($id)
    {
        return view('guncelle.guncelle-birim-turu', [
            'bulunanBirimTuru' => BirimTuru::find($id),
        ]);
    }

    public function guncelleCalisan(User $user)
    {
        return view('guncelle.guncelle-calisan', [
            'bulunanCalisan' => $user,
        ]);
    }

    public function guncelleFirma($id)
    {
        return view('guncelle.guncelle-firma', [
            'bulunanFirma' => Firma::find($id),
        ]);
    }

    public function guncelleMusteri($id)
    {
        return view('guncelle.guncelle-musteri', [
            'bulunanMusteri' => Musteri::find($id),
            'cekilenYetkililer' => User::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function guncelleUrun($id)
    {
        return view('guncelle.guncelle-urun', [
            'bulunanUrun' => Urun::find($id),
            'cekilenKategoriler' => UrunKategori::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenBirimler' => UrunBirim::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    public function guncelleUrunKategori($id)
    {
        return view('guncelle.guncelle-urun-kategori', [
            'bulunanUrunKategori' => UrunKategori::find($id),
        ]);
    }

    public function guncelleUrunBirim($id)
    {
        return view('guncelle.guncelle-urun-birim', [
            'bulunanUrunBirim' => UrunBirim::find($id),
        ]);
    }

    public function guncelleTalep($id)
    {
        return view('guncelle.guncelle-talep', [
            'bulunanTalep' => Talep::find($id),
            'bulunanTalepDetay' => TalepDetay::where('talep_id', $id)->get(),
            'cekilenUrunKategori' => UrunKategori::where('firma_id', Auth::user()->firma_id)->get(),
            'cekilenBirimler' => Birim::where('firma_id', Auth::user()->firma_id)->get(),
        ]);
    }

    //-----------------------------------------------------------------------Güncelle Sayfaları BİTİŞ


    //-----------------------------------------------------------------------Talep Onaylama
    public function talepOnayla($id) {
        $onayla = Talep::find($id)->update(['onay' => 1]);
        if ($onayla) {
            $statu = 'İşlem Başarılı';
            return redirect('talepler')->with('status', $statu);
        }

    }
    //-----------------------------------------------------------------------Talep Onaylama BİTİŞ





}
