<?php

namespace Axiom\Rivescript\Cortex\Triggers;

use Axiom\Collections\Collection;

class Wildcard extends Trigger
{
    /**
     * Parse the trigger.
     *
     * @param string $trigger
     * @param string $message
     *
     * @return array
     */
    public function parse($trigger, $input)
    {
        $trigger = $this->parseTags($trigger, $input);

        $wildcards = [
            '/\*$/'             => '.*?',
            '/\*/'              => '\\w+?',
            '/#/'               => '\\d+?',
            '/_/'               => '[a-z]?',
            '/<zerowidthstar>/' => '^\*$',
        ];

        foreach ($wildcards as $pattern => $replacement) {
            $parsedTrigger = preg_replace($pattern, '('.$replacement.')', $trigger);

            if (@preg_match_all('/'.$parsedTrigger.'$/u', $input->source(), $stars)) {
                array_shift($stars);

                $stars = Collection::make($stars)->flatten()->all();

                synapse()->memory->shortTerm()->put('stars', $stars);

                return $this->triggerFound();
            }
        }

        return $this->triggerNotFound();
    }
}
