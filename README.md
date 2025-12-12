🛒 Livewire Kasir – Penjelasan Lengkap Setiap Baris Kode

Di bawah ini adalah penjelasan lengkap fungsi dari setiap baris kode pada komponen Livewire kasir.

📌 Full Code + Penjelasan
public $cart = [];
public $products = [];


public $cart → tempat menyimpan item belanja (keranjang).

public $products → tempat menyimpan daftar produk dari database.

Keduanya dibuat public supaya bisa dipakai oleh Blade.

🔵 mount(): dijalankan sekali saat komponen pertama kali di-load
public function mount() {
    $this->products = Product::all();
    // jangan toArray()
    $this->cart = session('cart', []);
}


Penjelasan:

mount() adalah fungsi lifecycle Livewire yang dijalankan sekali saja di awal.

Product::all() → ambil semua produk dari database.

Tidak pakai ->toArray() agar tetap berupa objek (lebih mudah dipakai).

session('cart', []) → ambil cart dari session, kalau belum ada → isi array kosong.

🔵 getCart(): mengambil isi cart dari session
private function getCart() {
    return session('cart', $this->cart );
}


Fungsi ini mengambil cart yang tersimpan di session.

Kalau session kosong, dia pakai $this->cart.

🔵 saveCart(): simpan cart ke session + property Livewire
private function saveCart($cart) {
    $this->cart = $cart;
    session(['cart' => $cart]);
}


$this->cart = $cart → supaya Livewire langsung update tampilan.

session(['cart' => $cart]) → supaya cart tidak hilang saat refresh halaman.

🔵 add(): menambahkan produk ke cart
public function add($id) {
    if (! $product = Product::find((int)$id)) return;

    $cart = $this->getCart();

    $cart[$id] = [
        'id'    => $product->id,
        'title' => $product->title,
        'price' => (int)$product->price,
        'qty'   => ($cart[$id]['qty'] ?? 0) + 1,
    ];

    $this->saveCart($cart);
}


Penjelasan:

Product::find((int)$id) → cari produk berdasarkan ID, pastikan ID berupa angka.

Kalau produk tidak ditemukan → langsung return.

Ambil cart saat ini.

$cart[$id] = [...] → simpan produk ke dalam cart.

( $cart[$id]['qty'] ?? 0 ) + 1 →
artinya:

kalau sudah pernah ada → tambah quantity

kalau belum pernah ada → quantity mulai dari 1

Terakhir simpan kembali cart yang sudah diperbarui.

🔵 updateQty(): menambah atau mengurangi quantity
public function updateQty($id, $delta) {
    $cart = $this->getCart();
    if (isset($cart[$id])) {
        $cart[$id]['qty'] += $delta;
        if ($cart[$id]['qty'] <= 0) unset($cart[$id]);
        $this->saveCart($cart);
    }
}


Penjelasan:

$delta bisa +1 atau -1.

Update jumlah produk.

Jika qty jadi 0 atau minus → produk otomatis dihapus.

Simpan ulang cart.

🔵 remove(): menghapus 1 item dari cart
public function remove($id) {
    $cart = $this->getCart();
    unset($cart[$id]);
    $this->saveCart($cart);
}


Langsung menghapus item berdasarkan ID.

🔵 clearCart(): menghapus seluruh isi cart
public function clearCart() {
    $this->cart = [];
    session()->forget('cart');
}


Reset cart jadi array kosong.

Hapus dari session supaya benar-benar bersih.

🔵 getTotalProperty(): total harga otomatis
public function getTotalProperty() {
    return collect($this->cart)
        ->sum(fn($it) => $it['price'] * $it['qty']);
}


Penjelasan:

getTotalProperty() adalah Computed Property, diakses sebagai $this->total.

Hitung total dengan cara:

price * qty

lalu dijumlahkan semuanya (sum()).

🔵 render(): menampilkan view
public function render() {
    return view('livewire.kasir-traning', [
        'cart' => $this->cart,
    ])
    ->layout('components.layouts.app');
}


render() memutuskan Blade mana yang ditampilkan.

Mengirim variable $cart ke view.

->layout() digunakan agar memakai layout utama.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
