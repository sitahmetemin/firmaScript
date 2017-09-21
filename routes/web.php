<?php
use App\Urun;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------Get

//----------------------------------------------------------------Listeleme Sayfaları Başlangıç
Route::get('/login','AdminController@getLogin')->name('login');
Route::get('/logout','AdminController@logout')->name('logout');
Route::get('/','getController@getirHome');
Route::get('/birimler','getController@getirBirimler');
Route::get('/calisanlar','getController@getirCalisanlar');
Route::get('/firmalar','getController@getirFirmalar');
Route::get('/musteriler','getController@getirMusteriler');
Route::get('/urunler','getController@getirUrunler');

Route::get('/talepler','getController@getirTalepler');
Route::get('/talepler/detay-talep/{id}','getController@getirTalepDetay');

Route::get('/onaylanan-talepler','getController@getirOnaylananTalepler');
Route::get('/hareketler','getController@getirHareketler');
Route::get('/raporlar','getController@getirRaporlar');
//----------------------------------------------------------------Listeleme Sayfaları BİTİŞ

//----------------------------------------------------------------Ekleme Sayfaları Getir Başlangıç
Route::get('/firmalar/ekle-firma','getController@getirEkleFirma');
Route::get('/birimler/ekle-birim','getController@getirEkleBirim');
Route::get('/urunler/ekle-urun','getController@getirEkleUrun');
Route::get('/calisanlar/ekle-calisan','getController@getirEkleCalisan');
Route::get('/musteriler/ekle-musteri','getController@getirEkleMusteri');

Route::get('/talepler/ekle-talep','getController@getirEkleTalep');
Route::get('/talepler/ekle-talep/ajaxKategoriUrunleri/{id}', 'getController@talepKategoriUrunu');
Route::get('/talepler/ekle-talep/ajaxKategoriUrunleBirimleri/{id}', 'getController@talepUrunBirimi');

Route::get('/ekle-urun-kategori','getController@getirEkleUrunKategori');
Route::get('/ekle-urun-birimleri','getController@getirUrunBirimleri');
Route::get('/ekle-birim-turu','getController@getirEkleBirimTuru');
//----------------------------------------------------------------Ekleme Sayfaları Getir BİTİŞ

//-----------------------------------------------------------------Silme Linkler Başlangıç
Route::get('/calisanlar/sil-calisan/{id}', 'getController@silCalisan');
Route::get('/firmalar/sil-firma/{id}', 'getController@silFirma');
Route::get('/musteriler/sil-musteri/{id}', 'getController@silMusteri');
Route::get('/birimler/sil-birim/{id}', 'getController@silBirim');
Route::get('/urunler/sil-urun/{id}', 'getController@silUrun');
Route::get('/talepler/sil-talep/{id}', 'getController@silTalep');
Route::get('/onaylanan-talepler/sil-talep/{id}', 'getController@silOnaylananTalep');

Route::get('/ekle-birim-turu/sil-birimTuru/{id}', 'getController@silBirimTuru');
Route::get('/ekle-urun-kategori/sil-urunKategori/{id}', 'getController@silUrunKategori');
Route::get('/ekle-urun-birimleri/sil-urunBirim/{id}', 'getController@silUrunBirim');
//---------------------------------------------------------------------Silme Linkleri BİTİŞ

//---------------------------------------------------------------------Talep Onaylama Linkleri
Route::get('/talepler/onayla-talep/{id}', 'getController@talepOnayla');
//---------------------------------------------------------------------Talep Onaylama Linkleri BİTİŞ

//----------------------------------------------------------------------Güncelleme Sayfaları Getir Başlangıç
Route::get('/urunler/guncelle-urun/{id}','getController@guncelleUrun');
Route::get('/firmalar/guncelle-firma/{id}','getController@guncelleFirma');
Route::get('/calisanlar/guncelle-calisan/{user}','getController@guncelleCalisan');
Route::get('/musteriler/guncelle-musteri/{id}','getController@guncelleMusteri');
Route::get('/birimler/guncelle-birim/{id}','getController@guncelleBirim');
Route::get('/talepler/guncelle-talep/{id}','getController@guncelleTalep');
Route::get('/ekle-birim-turu/guncelle-birim-turu/{id}','getController@guncelleBirimTuru');
Route::get('/ekle-urun-kategori/guncelle-urun-kategori/{id}','getController@guncelleUrunKategori');
Route::get('/ekle-urun-birim/guncelle-urun-birim/{id}','getController@guncelleUrunBirim');
//----------------------------------------------------------------------Güncelleme Sayfaları Getir BİTİŞ

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------Post
Route::post('/login','AdminController@postLogin');
//--------------------------------------------------------------------------Veritabanına Ekle Başlangıç
Route::post('/firmalar/ekle-firma','PostController@postFirmaEkle');
Route::post('/urunler/ekle-urun','PostController@postUrunEkle');
Route::post('/birimler/ekle-birim','PostController@postBirimEkle');
Route::post('/musteriler/ekle-musteri','PostController@postMusteriEkle');
Route::post('/calisanlar/ekle-calisan','PostController@postCalisanEkle');
Route::post('/talepler/ekle-talep','PostController@postTalepEkle');

Route::post('/ekle-birim-turu','PostController@postBirimTuruEkle');
Route::post('/ekle-urun-kategori','PostController@postUrunKategoriEkle');
Route::post('/ekle-urun-birimleri','PostController@postUrunBirimleriEkle');
//--------------------------------------------------------------------------Veritabanına Ekle BİTİŞ

//------------------------------------------------------------------------- Veritabanı Güncelle İşlemi Başlangıç
Route::post('/urunler/guncelle-urun/{id}', 'PostController@postGuncelleUrun');
Route::post('/firmalar/guncelle-firma/{id}', 'PostController@postGuncelleFirma');
Route::post('/calisanlar/guncelle-calisan/{id}', 'PostController@postGuncelleCalisan');
Route::post('/musteriler/guncelle-musteri/{id}', 'PostController@postGuncelleMusteri');
Route::post('/birimler/guncelle-birim/{id}', 'PostController@postGuncelleBirim');
Route::post('/ekle-birim-turu/guncelle-birim-turu/{id}', 'PostController@postGuncelleBirimTuru');
Route::post('/ekle-urun-kategori/guncelle-urun-kategori/{id}', 'PostController@postGuncelleUrunKategori');
Route::post('/ekle-urun-birim/guncelle-urun-birim/{id}', 'PostController@postGuncelleUrunBirim');

//--------------------------------------------------------------------------  Veritabanı Güncelle İşlemi BİTİŞ


