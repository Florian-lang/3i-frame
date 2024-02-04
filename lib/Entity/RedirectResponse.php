<?php

namespace iFrame\Entity;

class RedirectResponse extends Response
{
    private string $url;

    public function __construct(string $url = '/', int $status = Response::HTTP_OK)
    {
        parent::__construct('', $status);

        $this->url = $url;
        header('Location: ' . $url, true, $status);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
