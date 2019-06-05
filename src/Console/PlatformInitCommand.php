<?php

namespace Fx\Platform\Console;

use Illuminate\Console\Command;

class PlatformInitCommand extends Command
{
    protected $signature = 'platform:init';

    protected $description = 'package fx/platform publish';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call("vendor:publish", [
            "--provider" => "Fx\\Platform\\Providers\\PlatformServiceProvider",
            "--force" => true
        ]);
    }
}
