<?php

namespace Axiom\Rivescript\Cortex\Commands;

use Axiom\Rivescript\Contracts\Command;

class Topic implements Command
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
        if ($node->command() === '>') {
            list($type, $topic) = explode(' ', $node->value());

            if ($type === 'topic') {
                if (! synapse()->brain->topic($topic)) {
                    synapse()->brain->createTopic($topic);
                }

                synapse()->memory->shortTerm()->put('topic', $topic);
            }
        }

        if ($node->command() === '<' and $node->value() === 'topic') {
            synapse()->memory->shortTerm()->remove('topic');
        }
    }
}
