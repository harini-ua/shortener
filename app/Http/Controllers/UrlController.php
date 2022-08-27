<?php

namespace App\Http\Controllers;

use App\Events\UrlClickEvent;
use App\Http\Requests\UrlRequest;
use App\Models\Url;
use App\Services\ShortenerService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /** @var ShortenerService $shortener */
    protected $shortener;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShortenerService $shortener)
    {
        $this->shortener = $shortener;
    }

    public function index()
    {
        return view('index');
    }

    /**
     * @param UrlRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function shorten(UrlRequest $request)
    {
        try {
            $url = $this->shortener->create(
                $request->get('url'),
                $request->get('expiry'),
                $request->get('limit'),
            );
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', __('Something went wrong, try again'));
        }

        return view('index', compact('url'));
    }

    /**
     * @param Request $request
     * @param $short_url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Request $request, $short_url)
    {
        $url = Url::where('short', $short_url)->first();

        UrlClickEvent::dispatch($url);

        return redirect()->to($url->long, 301);
    }
}
