<?php

namespace Axiom\Rivescript\Contracts;

use Axiom\Rivescript\Cortex\Input;

interface Tag
{
    /**
     * Parse the response.
     *
     * @param string $source
     * @param Input $input
     *
     * @return array
     */
    public function parse($source, Input $input);
}
