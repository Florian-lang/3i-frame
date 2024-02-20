<?php

namespace iFrame\Entity;

class JsonResponse extends Response
{
    /**
     * @param mixed[] $content
     */
    public function __construct(array $content = [], int $status = Response::HTTP_OK)
    {
        $encodedContent = json_encode($content);

        if ($encodedContent === false) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        parent::__construct($encodedContent, $status);
    }
}
