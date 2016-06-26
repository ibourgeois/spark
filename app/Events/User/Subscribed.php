<?php

namespace iBourgeois\Spark\Events\User;

use Illuminate\Queue\SerializesModels;

class Subscribed
{
    use Event, SerializesModels;
}
