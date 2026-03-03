<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Get news data from config.
     * Replace with Eloquent model when backend is ready.
     */
    private function getNewsData(): array
    {
        return config('berita', []);
    }

    /**
     * Display list of all news.
     */
    public function index(Request $request)
    {
        $allNews = $this->getNewsData();

        // Filter by category if requested
        $category = $request->query('kategori');
        if ($category) {
            $allNews = array_filter($allNews, fn ($n) => strtolower($n['category']) === strtolower($category));
        }

        // Search
        $q = $request->query('q');
        if ($q) {
            $allNews = array_filter($allNews, fn ($n) => str_contains(strtolower($n['title']), strtolower($q)) ||
                str_contains(strtolower($n['excerpt']), strtolower($q))
            );
        }

        $allNewsValues = array_values($allNews);
        $page = $request->get('page', 1);
        $perPage = 9;
        
        $paginatedNews = new \Illuminate\Pagination\LengthAwarePaginator(
            array_slice($allNewsValues, ($page - 1) * $perPage, $perPage),
            count($allNewsValues),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $categories = array_unique(array_column($this->getNewsData(), 'category'));

        return view('pages.berita.index', [
            'allNews'        => $paginatedNews,
            'categories'     => $categories,
            'activeCategory' => $category,
            'searchQuery'    => $q,
            'featuredNews'   => $this->getNewsData()[0],
        ]);
    }

    /**
     * Display a single news detail.
     */
    public function show(string $slug)
    {
        $all  = $this->getNewsData();
        $news = collect($all)->firstWhere('slug', $slug);

        abort_if(! $news, 404);

        // Related news (same category, exclude current)
        $related = collect($all)
            ->where('category', $news['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->all();

        // Recent news sidebar
        $recentNews = collect($all)->take(4)->all();

        return view('pages.berita.show', compact('news', 'related', 'recentNews'));
    }
}
