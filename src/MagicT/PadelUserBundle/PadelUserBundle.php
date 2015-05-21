<?php

namespace MagicT\PadelUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PadelUserBundle extends Bundle
{
	public function getParent()
    {
        return 'SonataUserBundle';
    }
}
