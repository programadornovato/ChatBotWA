<?php

namespace Axiom\Rivescript\Cortex\Triggers;

class Atomic extends Trigger
{
    /**
     * Parse the trigger.
     *
     * @param int    $key
     * @param string $trigger
     * @param string $message
     *
     * @return array
     */
    public function parse($trigger, $input)
    {
        $trigger = $this->parseTags($trigger, $input);

        if ($trigger === $input->source()) {
            return $this->triggerFound();
        }

        return $this->triggerNotFound();
    }
}
