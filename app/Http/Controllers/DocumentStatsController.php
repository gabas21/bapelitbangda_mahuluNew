<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentStat;

class DocumentStatsController extends Controller
{
    /**
     * Record a view and redirect to the file URL.
     * GET /dokumen-stats/view?key=...&type=...&category=...&url=...
     */
    public function view(Request $request)
    {
        $key      = $request->query('key', '');
        $type     = $request->query('type', 'dokumen');
        $category = $request->query('category', '');
        $url      = $request->query('url', '');

        if ($key) {
            DocumentStat::incrementViews($key, $type, $category);
        }

        if ($url) {
            return redirect()->away($url);
        }

        return back();
    }

    /**
     * Record a download and redirect (force-download) the file.
     * GET /dokumen-stats/download?key=...&type=...&category=...&url=...
     */
    public function download(Request $request)
    {
        $key      = $request->query('key', '');
        $type     = $request->query('type', 'dokumen');
        $category = $request->query('category', '');
        $url      = $request->query('url', '');

        if ($key) {
            DocumentStat::incrementDownloads($key, $type, $category);
        }

        if ($url) {
            // If it's a local file path, serve as download; otherwise redirect
            $localPath = public_path(str_replace(asset(''), '', $url));
            if (file_exists($localPath)) {
                return response()->download($localPath);
            }
            return redirect()->away($url);
        }

        return back();
    }

    /**
     * Return stats for a specific document key (JSON).
     * GET /dokumen-stats/stats?key=...
     */
    public function stats(Request $request)
    {
        $key = $request->query('key', '');
        if (!$key) {
            return response()->json(['views' => 0, 'downloads' => 0]);
        }

        $stat = DocumentStat::where('doc_key', $key)->first();
        return response()->json([
            'views'     => $stat ? $stat->views : 0,
            'downloads' => $stat ? $stat->downloads : 0,
        ]);
    }

    /**
     * Return stats for multiple document keys (JSON).
     * POST /dokumen-stats/batch
     * Body: { keys: ['key1', 'key2', ...] }
     */
    public function batch(Request $request)
    {
        $keys = $request->input('keys', []);
        if (empty($keys)) {
            return response()->json([]);
        }

        $stats = DocumentStat::whereIn('doc_key', $keys)->get()->keyBy('doc_key');

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = [
                'views'     => $stats->has($key) ? $stats[$key]->views : 0,
                'downloads' => $stats->has($key) ? $stats[$key]->downloads : 0,
            ];
        }

        return response()->json($result);
    }
}
