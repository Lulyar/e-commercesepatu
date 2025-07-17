<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shoe;
use App\Services\FrontService;  // Import FrontService
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    protected $frontService;

    // Constructor method to inject FrontService
    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $shoes = $this->frontService->searchShoes($keyword);

        return view('front.search', [
            'shoes' => $shoes,
            'keyword' => $keyword,
        ]);
    }

    /* ------------------------------------------------------------------ */
    /* 1. Beranda (Homepage)                                              */
    /* ------------------------------------------------------------------ */
    public function index()
    {
        // Ambil data front page dari FrontService
        $data = $this->frontService->getFrontPageData();

        // Menampilkan data ke view
        return view('front.index', $data);
    }

    /* ------------------------------------------------------------------ */
    /* 2. Detail produk (Product Details) – WAJIB load sizes              */
    /* ------------------------------------------------------------------ */
    public function details(Shoe $shoe)
    {
        // Memuat relasi: photos, brand, sizes (relasi pivot shoe_sizes)
        $shoe->load([
            'photos' => fn ($q) => $q->latest(),  // Memuat semua foto terkait sepatu, urutkan foto terbaru
            'brand',  // Memuat data brand terkait sepatu
            'sizes',  // Memuat ukuran sepatu dari tabel pivot shoe_sizes
        ]);

        // Mengembalikan view dengan data detail sepatu
        return view('front.details', compact('shoe'));
    }

    /* ------------------------------------------------------------------ */
    /* 3. Browse per kategori (Category Page)                             */
    /* ------------------------------------------------------------------ */
    public function category($slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return redirect()->route('front.index')->withErrors(['msg' => 'Category not found!']);
        }

        // Ambil produk terkait dengan kategori ini
        $shoes = $category->shoes()
                          ->with(['brand', 'photos' => fn ($q) => $q->latest()->limit(1)]) // Hanya foto terbaru
                          ->paginate(12);  // Membatasi produk yang ditampilkan per halaman

        return view('front.category', compact('category', 'shoes'));
    }

    /* ------------------------------------------------------------------ */
    /* 4. View All New Products                                            */
    /* ------------------------------------------------------------------ */
    public function allNew()
    {
        $shoes = Shoe::latest()
                     ->with(['brand', 'category', 'photos' => fn ($q) => $q->latest()->limit(1)])
                     ->paginate(12);
        
        return view('front.all_new', compact('shoes'));
    }
}
