<?php

namespace Axiom\Rivescript\Cortex\Commands;

use Axiom\Rivescript\Contracts\Command;

class Variable implements Command
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
        if ($node->command() === '!') {
            $type = strtok($node->value(), ' ');

            if ($type === 'var') {
                $value             = str_replace('var', '', $node->value());
                list($key, $value) = explode('=', $value);

                $key   = trim($key);
                $value = trim($value);

                synapse()->memory->variables()->put($key, $value);
            }
        }
    }
}
