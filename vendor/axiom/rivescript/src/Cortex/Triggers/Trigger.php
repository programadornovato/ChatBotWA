<?php

namespace Axiom\Rivescript\Cortex\Triggers;

use Axiom\Rivescript\Contracts\Trigger as TriggerContract;

abstract class Trigger implements TriggerContract
{
    public function triggerFound()
    {
        return true;
    }

    public function triggerNotFound()
    {
        return false;
    }

    /**
     * Parse the response through the available tags.
     *
     * @param string $response
     *
     * @return string
     */
    protected function parseTags($trigger, $input)
    {
        synapse()->tags->each(function ($tag) use (&$trigger, $input) {
            $class = "\\Axiom\\Rivescript\\Cortex\\Tags\\$tag";
            $tagClass = new $class('trigger');

            $trigger = $tagClass->parse($trigger, $input);
        });

        return mb_strtolower($trigger);
    }
}
