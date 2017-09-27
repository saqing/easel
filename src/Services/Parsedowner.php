<?php

namespace Canvas\Services;

use Parsedown as Parsedown;

class Parsedowner
{
    /**
     * Transform raw text to markdown.
     *
     * @return $html
     */
    public function toHTML($raw)
    {
        $html = Parsedown::instance()->text($raw);

        return $html;
    }
}
