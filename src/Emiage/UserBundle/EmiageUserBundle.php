<?php

namespace Emiage\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmiageUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
