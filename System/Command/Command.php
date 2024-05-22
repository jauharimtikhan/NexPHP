<?php

namespace System\Command;

abstract class Command
{
    protected $signature;
    protected $description;
    protected $arguments = [];

    public function __construct($arguments = [])
    {
        $this->arguments = $arguments;
    }

    public function argument($key)
    {
        return isset($this->arguments[$key]) ? $this->arguments[$key] : null;
    }

    abstract public function handle();
}
