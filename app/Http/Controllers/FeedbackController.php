<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Handle feedback form submission from the landing page.
     */
    public function store(StoreFeedbackRequest $request)
    {
        $validated = $request->validated();

        // Log the feedback (later can be stored in database)
        Log::channel('single')->info('Feedback diterima', [
            'nama'  => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'pesan' => $validated['pesan'],
            'ip'    => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Aspirasi Anda telah berhasil dikirim.',
        ]);
    }
}
