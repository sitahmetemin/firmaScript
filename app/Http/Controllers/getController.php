<?php

namespace App\Http\Controllers;

use App\Birim;
use App\BirimTuru;
use App\Firma;
use App\Hareket;
use App\Musteri;
use App\Proje;
use App\Talep;
use App\TalepDetay;
use App\Urun;
use App\UrunBirim;
use App\UrunKategori;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class getController extends AdminController
{

    public function getirLogin()
    {
        return view('login');
    }

    //------------------------------------------------------------SuperAdmin Session Bilgisi Alma
    public function firmaIDGiy($id)
    {
        session()->forget('firma_id');
        session()->put('firma_id', $id);
        return redirect('firmalar');
    }
    //------------------------------------------------------------SuperAdmin Session Bilgisi Alma

    //------------------------------------------------------------Listeleme Sayfaları
    public function getirHome()
    {
        return view('home', [
            'firmaAdet' => Firma::count(),
            'calisanAdet' => User::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->count(),
            'urunAdet' => Urun::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->count(),
            'musteriAdet' => Musteri::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->count(),
            'kategoriAdet' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->count(),
            'birimAdet' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->count(),
            'talepAdet' => Talep::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->where('onay', 0)->count(),
        ]);
    }

    public function getirFirmalar()
    {
        $this->authorize('view', Firma::class);
        return view('firmalar', [
            'cekilenFirmalar' => Firma::all(),
        ]);
    }

    public function getirBirimler()
    {
        $this->authorize('view', Birim::class);

        return view('birimler', [
            'cekilenBirimler' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleBirimTuru()
    {
        $this->authorize('view', BirimTuru::class);

        return view('ekle.ekle-birim-turu', [
            'cekilenBirimTurleri' => BirimTuru::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirCalisanlar()
    {
        $this->authorize('view', User::class);
        return view('calisanlar', [
            'cekilenCalisanlar' => User::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirMusteriler()
    {
        $this->authorize('view', Musteri::class);
        return view('musteriler', [
            'cekilenMusteriler' => Musteri::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirUrunler()
    {
        $this->authorize('view', Urun::class);

        return view('urunler', [
            'cekilenUrunler' => Urun::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirUrunBirimleri()
    {
        $this->authorize('view', UrunBirim::class);
        return view('ekle.ekle-urun-birimleri', [
            'cekilenUrunBirimleri' => UrunBirim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirTalepler()
    {
        $this->authorize('view', Talep::class);
        return view('talepler', [
            'cekilenTalepler' => Talep::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->where('onay', 0)->get(),
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
        $this->authorize('view', Talep::class);
        return view('onaylanan-talepler', [
            'cekilenTalep' => Talep::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->where('onay', 1)->get(),
        ]);
    }

    public function getirRaporlar()
    {
        return view('raporlar', [
            'cekilenBirim' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleProje()
    {
        $this->authorize('view', Proje::class);
        return view('ekle.ekle-proje', [
            'cekilenProjeler' => Proje::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenMusteriler' => Musteri::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirTransferYonetimi()
    {
        $this->authorize('view', Hareket::class);

        return view('transferler', [
            'cekilenTransferler' => Hareket::select('referans_id', 'hareket_yonu', 'birim_id', 'referans_tipi', 'created_at')->where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->where('hareket_yonu', 0)->groupBy('referans_tipi', 'referans_id', 'referans_id', 'hareket_yonu', 'birim_id', 'referans_tipi', 'created_at')->get(),
        ]);
    }

    //------------------------------------------------------------Listeleme Sayfaları BİTİŞ


    //-------------------------------------------------------------Ekleme sayfaları
    public function getirEkleBirim()
    {
        $this->authorize('view', Birim::class);
        return view('ekle.ekle-birim', [
            'cekilenTurler' => BirimTuru::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleFirma()
    {
        $this->authorize('view', Firma::class);
        return view('ekle.ekle-firma');
    }

    public function getirEkleCalisan()
    {
        $this->authorize('view', User::class);
        return view('ekle.ekle-calisan', [
            'cekilenBirimler' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenBirimTurleri' => BirimTuru::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenFirmalar' => Firma::all(),
        ]);
    }

    public function getirEkleMusteri()
    {
        $this->authorize('view', Musteri::class);

        return view('ekle.ekle-musteri', [
            'cekilenYetkililer' => User::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleUrun()
    {
        $this->authorize('view', Urun::class);
        return view('ekle.ekle-urun', [
            'kategoriler' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenBirimler' => UrunBirim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleUrunKategori()
    {
        $this->authorize('view', UrunKategori::class);
        return view('ekle.ekle-urun-kategori', [
            'urunKategorileri' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function getirEkleTalep()
    {
        $this->authorize('view', Talep::class);
        return view('ekle.ekle-talep', [
            'cekilenUrunBirimleri' => UrunBirim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenBirimler' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenUrunKategori' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function talepKategoriUrunu($id)
    {
        $urunler = Urun::where('kategori_id', $id)->get();
        return response()->json($urunler);
    }

    public function talepUrunBirimi($id)
    {
        $birimler = Urun::where('id', $id)->get();
        return response()->json($birimler);
    }

    //-----------------------------------------------------------------Ekleme sayfaları BİTİŞ

    //-----------------------------------------------------------------Silme Metodları
    public function silCalisan($id)
    {

        $delete = User::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('calisanlar')->with('status', $statu);
    }

    public function silBirim($id)
    {
        $delete = Birim::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('birimler')->with('status', $statu);
    }

    public function silFirma($id)
    {
        $delete = Firma::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('firmalar')->with('status', $statu);
    }

    public function silMusteri($id)
    {
        $delete = Musteri::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('musteriler')->with('status', $statu);
    }

    public function silUrun($id)
    {
        $delete = Urun::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('urunler')->with('status', $statu);
    }

    public function silUrunKategori($id)
    {
        $delete = UrunKategori::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-urun-kategori')->with('status', $statu);
    }

    public function silUrunBirim($id)
    {
        $delete = UrunBirim::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-urun-birimleri')->with('status', $statu);
    }

    public function silBirimTuru($id)
    {
        $delete = BirimTuru::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('ekle-birim-turu')->with('status', $statu);
    }

    public function silTalep($id)
    {
        $delete = Talep::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('talepler')->with('status', $statu);
    }

    public function silOnaylananTalep($id)
    {
        $delete = Talep::find($id);
        $this->authorize('delete', $delete);
        $delete->delete();
        $statu = 'İşlem Başarılı';
        return redirect('onaylanan-talepler')->with('status', $statu);
    }

    //-----------------------------------------------------------------------Silme Metodları BİTİŞ

    //-----------------------------------------------------------------------Güncelle Sayfaları
    public function guncelleBirim($id)
    {
        $this->authorize('view', Birim::class);
        return view('guncelle.guncelle-birim', [
            'bulunanBirim' => Birim::find($id),
            'cekilenBirimTuru' => BirimTuru::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function guncelleBirimTuru($id)
    {
        $this->authorize('view', BirimTuru::class);
        return view('guncelle.guncelle-birim-turu', [
            'bulunanBirimTuru' => BirimTuru::find($id),
        ]);
    }

    public function guncelleCalisan(User $user)
    {
        $this->authorize('view', User::class);
        return view('guncelle.guncelle-calisan', [
            'bulunanCalisan' => $user,
            'cekilenBirimler' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenFirmalar' => Firma::all(),
        ]);
    }

    public function guncelleFirma($id)
    {
        $this->authorize('view', Firma::class);
        return view('guncelle.guncelle-firma', [
            'bulunanFirma' => Firma::find($id),
        ]);
    }

    public function guncelleMusteri($id)
    {
        $this->authorize('view', Musteri::class);
        return view('guncelle.guncelle-musteri', [
            'bulunanMusteri' => Musteri::find($id),
            'cekilenYetkililer' => User::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function guncelleUrun($id)
    {
        $this->authorize('view', Urun::class);
        return view('guncelle.guncelle-urun', [
            'bulunanUrun' => Urun::find($id),
            'cekilenKategoriler' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenBirimler' => UrunBirim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    public function guncelleUrunKategori($id)
    {
        $this->authorize('view', UrunKategori::class);
        return view('guncelle.guncelle-urun-kategori', [
            'bulunanUrunKategori' => UrunKategori::find($id),
        ]);
    }

    public function guncelleUrunBirim($id)
    {
        $this->authorize('view', UrunBirim::class);
        return view('guncelle.guncelle-urun-birim', [
            'bulunanUrunBirim' => UrunBirim::find($id),
        ]);
    }

    public function guncelleTalep($id)
    {
        $this->authorize('view', Talep::class);
        return view('guncelle.guncelle-talep', [
            'bulunanTalep' => Talep::find($id),
            'bulunanTalepDetay' => TalepDetay::where('talep_id', $id)->get(),
            'cekilenUrunKategori' => UrunKategori::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
            'cekilenBirimler' => Birim::where('firma_id', (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id))->get(),
        ]);
    }

    //-----------------------------------------------------------------------Güncelle Sayfaları BİTİŞ


    //-----------------------------------------------------------------------Talep Onaylama
    public function talepOnayla($id)
    {
        $onayla = Talep::find($id)->update(['onay' => 1]);
        if ($onayla) {
            $statu = 'İşlem Başarılı';
            return redirect('talepler')->with('status', $statu);
        }
    }

    public function talepCikis($id,Request $request)
    {
//        $id = $request->id;

        $onayla = Talep::find($id)->update(['onay' => 2]);

        if ($onayla) {
            $i = 0;
            $talep = Talep::find($id);
            foreach ($talep->talepDetaylari as $talepDetay) {

                Hareket::create([
                    'referans_tipi' => 'talep',
                    'referans_id' => $talep->id,
                    'urun_id' => $talepDetay->urun_id,
                    'urun_birim_id' => $talepDetay->urun_birim_id,
                    'urun_miktar' => $talepDetay->urun_adet,
                    'hareket_yonu' => 0,
                    'birim_id' => $talep->birim_id,
                    'fatura_no' => $request->fatura_no,
                    'irsaliye_no' => $request->irsaliye_no,
                ]);
                $i++;
            }

            if ($i > 0) {
                $status = 'İşlem Başarılı';
                return redirect('onaylanan-talepler')->with('status', $status);
            }

            $statu = 'İşlem Başarılı';
            return redirect('onaylanan-talepler')->with('status', $statu);
        }
    }

    public function talepGiris($id)
    {
        $onayla = Talep::find($id)->update(['onay' => 3]);
        if ($onayla) {

            $i = 0;

            $talep = Talep::find($id);
            foreach ($talep->talepDetaylari as $talepDetay) {

                Hareket::create([
                    'referans_tipi' => 'talep',
                    'referans_id' => $talep->id,
                    'urun_id' => $talepDetay->urun_id,
                    'urun_birim_id' => $talepDetay->urun_birim_id,
                    'urun_miktar' => $talepDetay->urun_adet,
                    'hareket_yonu' => 1,
                    'birim_id' => $talep->birim_id,
                ]);
                $i++;
            }

            if ($i > 0) {
                $status = 'İşlem Başarılı';
                return redirect('transferler')->with('status', $status);
            }

            $statu = 'İşlem Başarılı';
            return redirect('transferler')->with('status', $statu);
        }
    }


    //-----------------------------------------------------------------------Talep Onaylama BİTİŞ


}
