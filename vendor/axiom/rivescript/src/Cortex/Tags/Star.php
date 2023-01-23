<?php

namespace Axiom\Rivescript\Cortex\Tags;

use Axiom\Rivescript\Cortex\Input;

class Star extends Tag
{
    /**
     * @var array
     */
    protected $allowedSources = ['response'];

    /**
     * Regex expression pattern.
     *
     * @var string
     */
    protected $pattern = '/<star(\d+)?>/i';

    /**
     * Parse the response.
     *
     * @param string $response
     * @param array  $data
     *
     * @return array
     */
    public function parse($source, Input $input)
    {
        if (! $this->sourceAllowed()) {
            return $source;
        }

        if ($this->hasMatches($source)) {
            $matches = $this->getMatches($source);
            $stars   = synapse()->memory->shortTerm()->get('stars');

            foreach ($matches as $key => $match) {
                $needle = $match[0];
                $index  = (empty($match[1]) ? 0 : $match[1] - 1);

                $source = str_replace($match[0], $stars[$index], $source);
            }
        }

        return $source;
    }
}
