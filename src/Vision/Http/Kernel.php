<?php

namespace Vision\Http;

class Kernel
{
    //
    public function capture(): Request
    {
        return new Request();
    }
}