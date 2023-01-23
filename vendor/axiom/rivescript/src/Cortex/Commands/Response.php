<?php

namespace Axiom\Rivescript\Cortex\Commands;

use Axiom\Rivescript\Contracts\Command;

class Response implements Command
{
    /**
     * Parse the command.
     *
     * @param Node   $node
     * @param string $command
     *
     * @return array
     */
    public function parse($node, $command)
    {
        if ($node->command() === '-') {
            $topic   = synapse()->memory->shortTerm()->get('topic') ?: 'random';
            $key     = synapse()->memory->shortTerm()->get('trigger');
            $trigger = synapse()->brain->topic($topic)->triggers()->get($key);

            $trigger['responses'][] = $node->value();

            synapse()->brain->topic($topic)->triggers()->put($key, $trigger);
        }
    }
}
