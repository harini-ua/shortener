<?php

namespace App\Services;

use App\Models\Url;
use Carbon\Carbon;

class ShortenerService
{
    /**
     * Create short url
     *
     * @param string $long_url
     * @param int $expiry
     * @param int $limit
     * @return Url
     */
    public function create(string $long_url, int $expiry = 24, int $limit = 0)
    {
        $url = Url::where('long', $long_url)
            ->first();

        if (!$url) {
            $url = new Url();
            $url->long = $long_url;
            $url->short = $this->generate();
            $url->limit = $limit;
            $url->expired_at = Carbon::now()->addHours($expiry);

            $url->save();
        }

        return $url;
    }

    /**
     * Generate short url
     *
     * @param $count
     * @return string
     */
    protected function generate($count = 8)
    {
        $characters = array_merge(
            array_flip(range('0', '9')),
            array_flip(range('a', 'z')),
            array_flip(range('A', 'Z'))
        );

        $short = str_shuffle(
            implode(array_rand($characters, $count))
        );

        if (Url::where('short', $short)->exists()) {
            $this->generate();
        }

        return $short;
    }
}
