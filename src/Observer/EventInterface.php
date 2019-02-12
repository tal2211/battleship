<?php

namespace Observer;

interface EventInterface
{
    public function getName();
    public function getSender();
}