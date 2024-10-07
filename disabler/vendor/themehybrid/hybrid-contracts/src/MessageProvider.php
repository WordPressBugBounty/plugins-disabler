<?php

namespace HBP_Disabler_Vendor\Hybrid\Contracts;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return \Hybrid\Contracts\MessageBag
     */
    public function getMessageBag();
}
