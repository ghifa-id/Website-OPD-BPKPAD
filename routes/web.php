<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AdminAlbumController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\AdminPengumumanController;
use App\Http\Controllers\Admin\AdminDownloadController;
use App\Http\Controllers\Admin\ProdukHukumController;
use App\Http\Controllers\Admin\AdminPPIDController;
use App\Http\Controllers\Admin\AdminAgendaController;
use App\Http\Controllers\Admin\DokperenlitbangController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Admin\surveyAdminController;
use App\Http\Controllers\BeritaUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\dokumenPublikController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\Kontributor\KontributorController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\InfopublikController;
use App\Http\Controllers\surveyController;
use App\Http\Controllers\KontakKamiController;
use App\Http\Controllers\RegistAkunController;
use App\Http\Middleware\SessionAuthMiddleware;
use App\Http\Middleware\PreventBackMiddleware;
use App\Http\Controllers\PublikPPIDController;
use App\Http\Middleware\StatistikPengunjung;
use App\Models\Pejabat;



Route::middleware([StatistikPengunjung::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('guest.beranda');
});
Route::get('berita/all', [BeritaUserController::class, 'showBeritaAll'])->name('showBeritaAll');
Route::get('berita/{slug}', [BeritaUserController::class, 'showBerita'])->name('berita.detail');
Route::post('berita/{id}/komentar', [BeritaUserController::class, 'postKomentar'])->name('berita.komentar');
Route::get('/berita/kategori/{slug}', [BeritaUserController::class, 'kategori'])->name('berita.kategori');
Route::post('/komentar/store', [BeritaUserController::class, 'postKomentar'])->name('komentar.store');
Route::post('/berita/like-dislike', [BeritaUserController::class, 'beritaLike'])->name('berita.like_dislike');
Route::get('dokumenPublik/all', [dokumenPublikController::class, 'showDokumenAll'])->name('showDokumenAll');
Route::get('/pdf/dokumen/{id}', [dokumenPublikController::class, 'showDokumen'])->name('dokumen.detail');
Route::get('/prestasi', [PenghargaanController::class, 'Penghargaan'])->name('penghargaan');
Route::get('/agenda', [AgendaController::class, 'Agenda'])->name('agenda');
Route::get('/pengumuman', [AnnouncementController::class, 'Announcement'])->name('pengumuman');
Route::get('/artikel', [ArtikelController::class, 'Artikel'])->name('artikel');
Route::get('/albums', [AlbumController::class, 'Foto'])->name('albums');
Route::get('/albums/{seo}', [AlbumController::class, 'showAlbum'])->name('foto.detail');
Route::get('/playlist', [AlbumController::class, 'Video'])->name('videoPlaylist');
Route::get('/playlist/{seo}', [AlbumController::class, 'showVideo'])->name('video.detail');
Route::get('/pdf/dokumen/{slug}', [PdfController::class, 'dokumen'])->name('pdf.dokumen');
Route::get('/page/detail/{slug}', [PageController::class, 'detail'])->name('page.detail');
Route::get('/pdf/detail/{jenis}', [PdfController::class, 'detail'])->name('pdf.detail');
Route::get('/ip/detail/{jenis}', [IpController::class, 'detail'])->name('ip.detail');
Route::get('/infopublik', [InfopublikController::class, 'index'])->name('infopublik');
Route::get('/infopublik/file/{filename}', [InfopublikController::class, 'file'])->name('infopublik.file');
Route::get('/infopublik/berkala', [InfopublikController::class, 'berkala'])->name('infopublik.berkala');
Route::get('/infopublik/sertamerta', [InfopublikController::class, 'sertamerta'])->name('infopublik.sertamerta');
Route::get('/infopublik/setiapsaat', [InfopublikController::class, 'setiapsaat'])->name('infopublik.setiapsaat');
//Route::get('/', [PageController::class, 'index'])->name('pejabat.index');
//Route::get('/', [PageController::class, 'showPejabatAll'])->name('guest.beranda');
Route::get('/pejabat/all', [PageController::class, 'showPejabatAll'])->name('showPejabatAll');
Route::get('/agenda/all', [PageController::class, 'showAgendaAll'])->name('showAgendaAll');
Route::get('/pejabat/{slug}', [PageController::class, 'show'])->name('pejabat.detail');
Route::get('/kepuasanPublik', [surveyController::class, 'kepuasanPublik'])->name('kepuasanPublik');
Route::post('/kepuasanPublik', [surveyController::class, 'kepuasanPublikStore'])->name('kepuasanPublik.Store');
Route::match(['get', 'post'], '/kontakKami', [KontakKamiController::class, 'kontakKami'])->name('kontakKami');
Route::get('/Registakun', [RegistAkunController::class, 'index'])->name('Registakun');
Route::post('/Registakun/add', [RegistAkunController::class, 'add'])->name('regist_akun.add');Route::get('/transparasi/file/{filename}', [PublikPPIDController::class, 'previewFile'])->name('ppid.preview');

Route::resource('menu', MenuController::class);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'aksi_login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Jika akses /administrator, redirect ke form login
Route::get('/administrator', function () {
    return redirect()->Route('login'); // redirect ke Route login
});
Route::middleware(['auth'])->group(function () {
    Route::get('/administrator/regist-akun', [RegistAkunController::class, 'show'])->name('regist_akun.show');
    Route::get('/administrator/regist-akun/{id}/edit', [RegistAkunController::class, 'edit'])->name('regist_akun.edit');
    Route::put('/administrator/regist-akun/{id}', [RegistAkunController::class, 'update'])->name('regist_akun.update');
    Route::delete('/administrator/regist-akun/{id}', [RegistAkunController::class, 'destroy'])->name('regist_akun.destroy');
});

// Route admin yang butuh session logingogin
Route::middleware([SessionAuthMiddleware::class, PreventBackMiddleware::class])
    ->prefix('administrator')
    ->group(function () {
        Route::get('/beranda', [AdminController::class, 'index'])->name('administrator.beranda');
        Route::get('/beranda/statistik', [AdminController::class, 'getStatistikApi'])->name('admin.dashboard.statistik');
        Route::get('/beranda/survey', [AdminController::class, 'kepuasanPublikAdmin'])->name('admin.dashboard.survey');
        Route::post('/beranda', [AdminController::class, 'beritaCepat'])->name('administrator.beritaCepat');

        // Identitas Website
        Route::prefix('/')->group(function () {
            Route::get('/identitaswebsite', [AdminController::class, 'identitaswebsite'])->name('identitaswebsite');
            Route::post('/identitas/update', [AdminController::class, 'update'])->name('identitas.update');
        });

        // Menu Website
        Route::prefix('/')->group(function () {
            Route::get('/judulmenu', [AdminController::class, 'menuWebsite'])->name('judulmenu');
            Route::get('/tambah_menuwebsite', [AdminController::class, 'tambah_menuWebite'])->name('tambah_menuwebsite');
            Route::post('/tambah_menuwebsite', [AdminController::class, 'simpan_MenuWebsite'])->name('store_menuwebsite');
            Route::get('/edit_menuwebsite/{id}', [AdminController::class, 'edit_menuWebsite'])->name('edit_menuwebsite');
            Route::post('/update_menuwebsite/{id}', [AdminController::class, 'update_menuWebsite'])->name('update_menuwebsite');
            Route::delete('/judulmenu/{id}', [AdminController::class, 'delete_menuWebsite'])->name('delete_menuwebsite');
        });

        // Halaman Baru (Konten Menu)
        Route::prefix('/')->group(function () {
            Route::get('/kontenmenu', [AdminController::class, 'halamanBaru'])->name('kontenmenu');
            Route::get('/tambah_halamanbaru', [AdminController::class, 'tambah_halamanBaru'])->name('tambah_halamanbaru');
            Route::post('/tambah_halamanbaru', [AdminController::class, 'simpan_halamanBaru'])->name('store_halamanbaru');
            Route::get('/edit_halamanbaru/{id_menu}', [AdminController::class, 'edit_halamanBaru'])->name('edit_halamanbaru');
            Route::post('/update_halamanbaru/{id_menu}', [AdminController::class, 'update_halamanBaru'])->name('update_halamanbaru');
            Route::delete('/kontenmenu/{id_menu}', [AdminController::class, 'delete_halamanBaru'])->name('delete_halamanbaru');
        });

        Route::prefix('/')->group(function () {
            Route::get('/penghargaan', [AdminController::class, 'penghargaan'])->name('administrator.penghargaan');
            Route::get('/tambah_penghargaan', [AdminController::class, 'tambah_penghargaan'])->name('tambah_penghargaan');
            Route::post('/tambah_penghargaan', [AdminController::class, 'simpan_penghargaan'])->name('store_penghargaan');
            Route::get('/edit_penghargaan/{id_menu}', [AdminController::class, 'edit_penghargaan'])->name('edit_penghargaan');
            Route::post('/update_penghargaan/{id_menu}', [AdminController::class, 'update_penghargaan'])->name('update_penghargaan');
            Route::delete('/penghargaan/{id_menu}', [AdminController::class, 'delete_penghargaan'])->name('delete_penghargaan');
        });



        // Jabatan 
        Route::prefix('/')->group(function () {
            Route::get('/jabatan', [PejabatController::class, 'Jabatan'])->name('jabatan');
            Route::get('/tambah_jabatan', [PejabatController::class, 'tambah_Jabatan'])->name('tambah_jabatan');
            Route::post('/tambah_jabatan', [PejabatController::class, 'simpan_Jabatan'])->name('store_jabatan');
            Route::get('/edit_jabatan/{id}', [PejabatController::class, 'edit_Jabatan'])->name('edit_jabatan');
            Route::post('/update_jabatan/{id_menu}', [PejabatController::class, 'update_Jabatan'])->name('update_jabatan');
            Route::delete('/jabatan/{jabatan_id}', [PejabatController::class, 'delete_Jabatan'])->name('delete_jabatan');
        });

        // Pejabat
        Route::prefix('/')->group(function () {
            Route::get('/pejabat', [PejabatController::class, 'Pejabat'])->name('pejabat');
            Route::post('/pejabat/simpan', [PejabatController::class, 'simpan_Pejabat'])->name('store_pejabat');
            Route::get('/pejabat/edit/{pejabat_id}', [PejabatController::class, 'edit_Pejabat'])->name('edit_pejabat');
            Route::put('/pejabat/update/{pejabat_id}', [PejabatController::class, 'update_Pejabat'])->name('update_pejabat');
            Route::delete('/pejabat/delete/{pejabat_id}', [PejabatController::class, 'delete_Pejabat'])->name('delete_pejabat');
            Route::get('/pejabat/tambah', [PejabatController::class, 'tambah_Pejabat'])->name('tambah_pejabat');
        });
        // listBerita
        Route::prefix('/')->group(function () {
            Route::get('/listberita', [BeritaController::class, 'listBerita'])->name('listberita');
            Route::get('/tambah_listberita', [BeritaController::class, 'tambah_listBerita'])->name('tambah_listberita');
            Route::post('/tambah_listberita', [BeritaController::class, 'simpan_listBerita'])->name('store.listberita');
            Route::get('/edit_listberita/{id_berita}', [BeritaController::class, 'edit_listBerita'])->name('edit_listberita');
            Route::post('/update_listberita/{id_berita}', [BeritaController::class, 'update_listBerita'])->name('update_listberita');
            Route::delete('/listberita/{id_berita}', [BeritaController::class, 'delete_listBerita'])->name('delete_listberita');
        });

        // Kategori Berita
        Route::get('/kategoriberita', [BeritaController::class, 'kategoriBerita'])->name('kategoriberita');
        Route::get('/tambah_kategoriberita', [BeritaController::class, 'tambah_kategoriBerita'])->name('tambah_kategoriberita');
        Route::post('/tambah_kategoriberita', [BeritaController::class, 'simpan_kategoriBerita'])->name('store.kategoriberita');
        Route::get('/edit_kategoriberita/{id_kategori}', [BeritaController::class, 'edit_kategoriBerita'])->name('edit_kategoriberita');
        Route::post('/update_kategoriberita/{id_kategori}', [BeritaController::class, 'update_kategoriBerita'])->name('update.kategoriBerita');
        Route::delete('/kategoriberita/{id_kategori}', [BeritaController::class, 'delete_kategoriBerita'])->name('delete_kategoriberita');

        // Album & Gallery
        Route::get('/album', [AdminAlbumController::class, 'album'])->name('album');
        Route::get('/tambah_album', [AdminAlbumController::class, 'tambah_Album'])->name('tambah_album');
        Route::post('/tambah_album', [AdminAlbumController::class, 'simpan_Album'])->name('store.album');
        Route::get('/edit_album/{id_album}', [AdminAlbumController::class, 'edit_Album'])->name('edit_album');
        Route::post('/update_album/{id_album}', [AdminAlbumController::class, 'update_Album'])->name('update_album');
        Route::delete('/album/{id_album}', [AdminAlbumController::class, 'delete_Album'])->name('delete_album');

        Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');
        Route::get('/tambah_gallery', [GalleryController::class, 'tambah_Gallery'])->name('tambah_gallery');
        Route::post('/tambah_gallery', [GalleryController::class, 'simpan_Gallery'])->name('store.gallery');
        Route::get('/edit_gallery/{id_gallery}', [GalleryController::class, 'edit_Gallery'])->name('edit_gallery');
        Route::post('/update_gallery/{id_gallery}', [GalleryController::class, 'update_Gallery'])->name('update.gallery');
        Route::delete('/gallery/{id_gallery}', [GalleryController::class, 'delete_Gallery'])->name('delete_gallery');

        // Playlist & Video
        Route::get('/playlist', [PlaylistController::class, 'Playlist'])->name('playlist');
        Route::get('/tambah_playlist', [PlaylistController::class, 'tambah_Playlist'])->name('tambah_playlist');
        Route::post('/tambah_playlist', [PlaylistController::class, 'simpan_Playlist'])->name('store.playlist');
        Route::get('/edit_playlist/{id_playlist}', [PlaylistController::class, 'edit_Playlist'])->name('edit_playlist');
        Route::post('/update_playlist/{id_playlist}', [PlaylistController::class, 'update_Playlist'])->name('update.playlist');
        Route::delete('/playlist/{id_playlist}', [PlaylistController::class, 'delete_Playlist'])->name('delete_playlist');

        Route::get('/video', [VideoController::class, 'video'])->name('video');
        Route::get('/tambah_video', [VideoController::class, 'tambah_video'])->name('tambah_video');
        Route::post('/tambah_video', [VideoController::class, 'simpan_video'])->name('store.video');
        Route::get('/edit_video/{id_video}', [VideoController::class, 'edit_video'])->name('edit_video');
        Route::post('/update_video/{id_video}', [VideoController::class, 'update_video'])->name('update.video');
        Route::delete('/video/{id_video}', [VideoController::class, 'delete_video'])->name('delete_video');

        // Kepuasan Publik
        Route::get('/kepuasanPublik', [SurveyAdminController::class, 'kepuasanPublikAdmin'])->name('kepuasanPublik.Admin');

        // Pengumuman & Download
        Route::get('/pengumumanAdmin', [AdminPengumumanController::class, 'pengumumanAdmin'])->name('admin.pengumuman');
        Route::get('/tambah_pengumumanAdmin', [AdminPengumumanController::class, 'tambah_pengumumanAdmin'])->name('tambah_pengumumanAdmin');
        Route::post('/tambah_pengumumanAdmin', [AdminPengumumanController::class, 'simpan_pengumumanAdmin'])->name('store.pengumumanAdmin');
        Route::get('/edit_pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'edit_pengumumanAdmin'])->name('edit_pengumumanAdmin');
        Route::post('/update_pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'update_pengumumanAdmin'])->name('update.pengumumanAdmin');
        Route::delete('/pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'delete_pengumumanAdmin'])->name('delete_pengumumanAdmin');
        Route::get('/download', [AdminDownloadController::class, 'download'])->name('download');
        Route::get('/tambah_downloadAdmin', [AdminDownloadController::class, 'tambah_downloadAdmin'])->name('tambah_downloadAdmin');
        Route::post('/tambah_downloadAdmin', [AdminDownloadController::class, 'simpan_downloadAdmin'])->name('store.downloadAdmin');
        Route::get('/edit_downloadAdmin/{id_download}', [AdminDownloadController::class, 'edit_downloadAdmin'])->name('edit_downloadAdmin');
        Route::post('/update_downloadAdmin/{id_download}', [AdminDownloadController::class, 'update_downloadAdmin'])->name('update.downloadAdmin');
        Route::delete('/downloadAdmin/{id_download}', [AdminDownloadController::class, 'delete_downloadAdmin'])->name('delete_downloadAdmin');

        // Produk Hukum & PPID
        Route::get('/produk-hukum', [ProdukHukumController::class, 'produkHukum'])->name('produkhukum');
        Route::get('/tambah_produkHukum', [ProdukHukumController::class, 'tambah_produkHukum'])->name('tambah_produkHukum');
        Route::post('/tambah_produkHukum', [ProdukHukumController::class, 'simpan_produkHukum'])->name('store.produkHukum');
        Route::get('/edit_produkHukum/{id_produk_hukum}', [ProdukHukumController::class, 'edit_produkHukum'])->name('edit_produkHukum');
        Route::post('/update_produkHukum/{id_produk_hukum}', [ProdukHukumController::class, 'update_produkHukum'])->name('update.produkHukum');
        Route::delete('/produkHukum/{id_produk_hukum}', [ProdukHukumController::class, 'delete_produkHukum'])->name('delete_produkHukum');

        Route::get('/ppid', [AdminPPIDController::class, 'ppidAdmin'])->name('ppid');
        Route::get('/tambah_ppidAdmin', [AdminPPIDController::class, 'tambah_ppidAdmin'])->name('tambah_ppidAdmin');
        Route::post('/tambah_ppidAdmin', [AdminPPIDController::class, 'simpan_ppidAdmin'])->name('store.ppidAdmin');
        Route::get('/edit_ppidAdmin/{id_transparasi}', [AdminPPIDController::class, 'edit_ppidAdmin'])->name('edit_ppidAdmin');
        Route::post('/update_ppidAdmin/{id_transparasi}', [AdminPPIDController::class, 'update_ppidAdmin'])->name('update.ppidAdmin');
        Route::delete('/ppid/{id_transparasi}', [AdminPPIDController::class, 'delete_ppidAdmin'])->name('delete_ppidAdmin');

        Route::get('/ppid-konten', [AdminPPIDController::class, 'ppidKonten'])->name('ppidkonten');
        Route::get('/tambah_ppidKontenAdmin', [AdminPPIDController::class, 'tambah_ppidKontenAdmin'])->name('tambah_ppidKontenAdmin');
        Route::post('/tambah_ppidKontenAdmin', [AdminPPIDController::class, 'simpan_ppidKontenAdmin'])->name('store.ppidKontenAdmin');
        Route::get('/edit_ppidKontenAdmin/{id_ppidkonten}', [AdminPPIDController::class, 'edit_ppidKontenAdmin'])->name('edit_ppidKontenAdmin');
        Route::post('/update_ppidKontenAdmin/{id_ppidkonten}', [AdminPPIDController::class, 'update_ppidKontenAdmin'])->name('update.ppidKontenAdmin');
        Route::delete('/ppidKontenAdmin/{id_ppidkonten}', [AdminPPIDController::class, 'delete_ppidKontenAdmin'])->name('delete_ppidKontenAdmin');

        // Agenda & Kependudukan
        Route::get('/agendaAdmin', [AdminAgendaController::class, 'agendaAdmin'])->name('administrator.agenda');
        Route::get('/tambah_agendaAdmin', [AdminAgendaController::class, 'tambah_agendaAdmin'])->name('tambah_agendaAdmin');
        Route::post('/tambah_agendaAdmin', [AdminAgendaController::class, 'simpan_agendaAdmin'])->name('store.agendaAdmin');
        Route::get('/edit_agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'edit_agendaAdmin'])->name('edit_agendaAdmin');
        Route::post('/update_agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'update_agendaAdmin'])->name('update.agendaAdmin');
        Route::delete('/agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'delete_agendaAdmin'])->name('delete_agendaAdmin');

        Route::get('/Dokperenlitbang', [DokperenlitbangController::class, 'Dokperenlitbang'])->name('Dokperenlitbang');
        Route::get('/tambah_Dokperenlitbang', [DokperenlitbangController::class, 'tambah_Dokperenlitbang'])->name('tambah_Dokperenlitbang');
        Route::post('/tambah_Dokperenlitbang', [DokperenlitbangController::class, 'simpan_Dokperenlitbang'])->name('store.Dokperenlitbang');
        Route::get('/edit_Dokperenlitbang/{id_Dokperenlitbang}', [DokperenlitbangController::class, 'edit_Dokperenlitbang'])->name('edit_Dokperenlitbang');
        Route::post('/update_Dokperenlitbang/{id_Dokperenlitbang}', [DokperenlitbangController::class, 'update_Dokperenlitbang'])->name('update.Dokperenlitbang');
        Route::delete('/Dokperenlitbang/{id_Dokperenlitbang}', [DokperenlitbangController::class, 'delete_Dokperenlitbang'])->name('delete_Dokperenlitbang');

        // Manajemen User
        Route::get('/manajemenuser', [ManajemenUserController::class, 'manajemenUser'])->name('manajemenuser');
        Route::get('/tambah_manajemenuser', [ManajemenUserController::class, 'tambah_manajemenuser'])->name('tambah.manajemenuser');
        Route::post('/tambah_manajemenuser', [ManajemenUserController::class, 'simpan_manajemenuser'])->name('store.manajemenuser');
        Route::get('/edit_manajemenuser/{id_username}', [ManajemenUserController::class, 'edit_manajemenuser'])->name('edit_manajemenuser');
        Route::post('/update_manajemenuser/{id_username}', [ManajemenUserController::class, 'update_manajemenuser'])->name('update.manajemenuser');
        Route::delete('/manajemenuser/{id_username}', [ManajemenUserController::class, 'delete_manajemenuser'])->name('delete_manajemenuser');
        // Route untuk edit profil user yang login
        Route::get('/edit-profil', [ManajemenUserController::class, 'editProfil'])->name('edit.profil');
        Route::post('/update-profil', [ManajemenUserController::class, 'updateProfil'])->name('update.profil');
    });


Route::middleware([SessionAuthMiddleware::class, PreventBackMiddleware::class])
    ->prefix('kontributor')
    ->group(function () {
        Route::get('/beranda', [KontributorController::class, 'index'])->name('kontributor.beranda');
        Route::get('/beranda/statistik', [KontributorController::class, 'getStatistikApi'])->name('statistik');
        Route::post('/beranda', [KontributorController::class, 'beritaCepat'])->name('kontributor.beritaCepat');

        Route::prefix('/')->group(function () {
            Route::get('/listberita', [KontributorController::class, 'listBerita'])->name('kontributor_listberita');
            Route::get('/tambah_listberita', [KontributorController::class, 'tambah_listBerita'])->name('kontributor_tambah_listberita');
            Route::post('/tambah_listberita', [KontributorController::class, 'simpan_listBerita'])->name('kontributor_store.listberita');
            // Route::get('/edit_listberita/{id_berita}', [KontributorController::class, 'edit_listBerita'])->name('edit_listberita');
            // Route::post('/update_listberita/{id_berita}', [KontributorController::class, 'update_listBerita'])->name('update_listberita');
            // Route::delete('/listberita/{id_berita}', [KontributorController::class, 'delete_listBerita'])->name('delete_listberita');

            Route::get('/album', [KontributorController::class, 'album'])->name('kontributor_album');
            Route::get('/tambah_album', [KontributorController::class, 'tambah_Album'])->name('kontributor_tambah_album');
            Route::post('/tambah_album', [KontributorController::class, 'simpan_Album'])->name('kontributor_store.album');
            // Route::get('/edit_album/{id_album}', [AdminAlbumControllerr::class, 'edit_Album'])->name('edit_album');
            // Route::post('/update_album/{id_album}', [AdminAlbumControllerr::class, 'update_Album'])->name('update_album');
            // Route::delete('/album/{id_album}', [AdminAlbumControllerr::class, 'delete_Album'])->name('delete_album');

            Route::get('/gallery', [KontributorController::class, 'gallery'])->name('kontributor_gallery');
            Route::get('/tambah_gallery', [KontributorController::class, 'tambah_Gallery'])->name('kontributor_tambah_gallery');
            Route::post('/tambah_gallery', [KontributorController::class, 'simpan_Gallery'])->name('kontributor_store.gallery');
            // Route::get('/edit_gallery/{id_gallery}', [GalleryController::class, 'edit_Gallery'])->name('edit_gallery');
            // Route::post('/update_gallery/{id_gallery}', [GalleryController::class, 'update_Gallery'])->name('update.gallery');
            // Route::delete('/gallery/{id_gallery}', [GalleryController::class, 'delete_Gallery'])->name('delete_gallery');

            // Playlist & Video
            Route::get('/playlist', [KontributorController::class, 'Playlist'])->name('kontributor_playlist');
            Route::get('/tambah_playlist', [KontributorController::class, 'tambah_Playlist'])->name('kontributor_tambah_playlist');
            Route::post('/tambah_playlist', [KontributorController::class, 'simpan_Playlist'])->name('kontributor_store.playlist');
            // Route::get('/edit_playlist/{id_playlist}', [PlaylistController::class, 'edit_Playlist'])->name('edit_playlist');
            // Route::post('/update_playlist/{id_playlist}', [PlaylistController::class, 'update_Playlist'])->name('update.playlist');
            // Route::delete('/playlist/{id_playlist}', [PlaylistController::class, 'delete_Playlist'])->name('delete_playlist');

            Route::get('/video', [KontributorController::class, 'video'])->name('kontributor_video');
            Route::get('/tambah_video', [KontributorController::class, 'tambah_video'])->name('kontributor_tambah_video');
            Route::post('/tambah_video', [KontributorController::class, 'simpan_video'])->name('kontributor_store.video');
            // Route::get('/edit_video/{id_video}', [VideoController::class, 'edit_video'])->name('edit_video');
            // Route::post('/update_video/{id_video}', [VideoController::class, 'update_video'])->name('update.video');
            // Route::delete('/video/{id_video}', [VideoController::class, 'delete_video'])->name('delete_video');

            // Pengumuman & Download
            Route::get('/pengumumanKontributor', [KontributorController::class, 'pengumumanKontributor'])->name('kontributor_pengumuman');
            Route::get('/tambah_pengumumanKontributor', [KontributorController::class, 'tambah_pengumumanKontributor'])->name('kontributor_tambah_pengumuman');
            Route::post('/tambah_pengumumanKontributor', [KontributorController::class, 'simpan_pengumumanKontributor'])->name('kontributor_store.pengumuman');
            // Route::get('/edit_pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'edit_pengumumanAdmin'])->name('edit_pengumumanAdmin');
            // Route::post('/update_pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'update_pengumumanAdmin'])->name('update.pengumumanAdmin');
            // Route::delete('/pengumumanAdmin/{id_announcement}', [AdminPengumumanController::class, 'delete_pengumumanAdmin'])->name('delete_pengumumanAdmin');

            Route::get('/download', [KontributorController::class, 'download'])->name('kontributor_download');
            Route::get('/tambah_downloadAdmin', [KontributorController::class, 'tambah_downloadKontributor'])->name('kontributor_tambah_download');
            Route::post('/tambah_downloadAdmin', [KontributorController::class, 'simpan_downloadKontributor'])->name('kontributor_store.download');
            // Route::get('/edit_downloadAdmin/{id_download}', [AdminDownloadController::class, 'edit_downloadAdmin'])->name('edit_downloadAdmin');
            // Route::post('/update_downloadAdmin/{id_download}', [AdminDownloadController::class, 'update_downloadAdmin'])->name('update.downloadAdmin');
            // Route::delete('/downloadAdmin/{id_download}', [AdminDownloadController::class, 'delete_downloadAdmin'])->name('delete_downloadAdmin');

            Route::get('/agendaKontributor', [KontributorController::class, 'agendaKontributor'])->name('kontributor_agenda');
            Route::get('/tambah_agendaKontributor', [KontributorController::class, 'tambah_agendaKontributor'])->name('kontributor_tambah_agenda');
            Route::post('/tambah_agendaKontributor', [KontributorController::class, 'simpan_agendaKontributor'])->name('kontributor_store.agenda');
            // Route::get('/edit_agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'edit_agendaAdmin'])->name('edit_agendaAdmin');
            // Route::post('/update_agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'update_agendaAdmin'])->name('update.agendaAdmin');
            // Route::delete('/agendaAdmin/{id_agenda}', [AdminAgendaController::class, 'delete_agendaAdmin'])->name('delete_agendaAdmin');

            Route::get('/kepuasanPublik', [KontributorController::class, 'kepuasanPublikKontributor'])->name('kepuasanPublik.Kontributor');


            Route::get('/edit-profil', [KontributorController::class, 'editProfilKontributor'])->name('Kontributor_edit_profil');
            Route::post('/update-profil', [KontributorController::class, 'updateProfilKontributor'])->name('Kontributor_update_profil');
        });
    });
