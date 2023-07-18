<?php

namespace Vision\Foundation;

use Vision\Http\Kernel as HttpKernel;

class App
{

    private static string $basePath;

    private static bool $isBootstrapped = false;
    private HttpKernel $kernel;
    private \Vision\Http\Request $request;

    public function __construct()
    {
        static::$basePath = dirname(__DIR__, 5);
    }

    public function bootstrap(): void
    {
        if(self::$isBootstrapped)
        {
            throw new \Exception('You can only bootstrap the app once');
        }

        $this->bootKernel();
    }

    private function bootKernel(): void
    {
        $this->kernel = new HttpKernel();
        $this->request = $this->kernel->capture();
    }

    public function getURL()
    {
        if ($_SERVER['REQUEST_URI'])
        {
            $url = rtrim(strtolower($_SERVER['REQUEST_URI']), '/');
            // Filter de url van alles wat niet in een url thuishoort
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }
}