<?php

namespace Aztech\Events\Bus\Plugins\Stomp;

use Aztech\Events\Bus\Channel\ChannelProvider;
use Aztech\Events\Bus\Channel\ReadWriteChannel;
use FuseSource\Stomp\Stomp;

class StompChannelProvider implements ChannelProvider
{

    public function createChannel(array $options = array())
    {
        $brokerUri = sprintf('%s://%s:%s', $options['scheme'], $options['host'], $options['port']);
        $client = new Stomp($brokerUri);

        $reader = new StompChannelReader($client, $options['queue']);
        $writer = new StompChannelWriter($client, $options['queue']);

        return new ReadWriteChannel($reader, $writer);
    }
}
