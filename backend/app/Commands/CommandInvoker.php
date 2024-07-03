<?php

namespace App\Commands;

/**
 * CommandInvoker
 */
class CommandInvoker
{
    private $command;
    
    /**
     * setCommand
     *
     * @param  mixed $command
     * @return void
     */
    public function setCommand(CommandInterface $command)
    {
        $this->command = $command;
    }
    
    /**
     * executeCommand
     *
     * @return void
     */
    public function executeCommand()
    {
        return $this->command->execute();
    }
}