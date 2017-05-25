<?php
/**
 * This file is part of devrun.
 * Copyright (c) 2017
 *
 * @file    IntroControl.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace Devrun\CmsModule\FrontModule\Controls;

use Flame\Application\UI\Control;

interface IIntroControlFactory
{
    /** @return IntroControl */
    function create();
}

class IntroControl extends Control
{


    public function render()
    {
        $template = $this->getTemplate();

        $template->render();
    }


}