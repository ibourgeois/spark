<?php

namespace iBourgeois\Spark\Events\User;

use Illuminate\Queue\SerializesModels;

class Registered
{
    use Event, SerializesModels;
}
