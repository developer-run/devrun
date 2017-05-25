<?php
/**
 * This file is part of devrun.
 * Copyright (c) 2017
 *
 * @file    CategoryPresenter.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace FrontModule\Presenters;


use Devrun\CatalogModule\Presenters\CatalogPresenterTrait;
use Devrun\CmsModule\Presenters\CmsPresenterTrait;

class CategoryPresenter extends \Devrun\CatalogModule\Presenters\CategoryPresenter
{

    use CmsPresenterTrait;
    use CatalogPresenterTrait;


    public function renderView($id)
    {
//        parent::renderView($id);


//        dump($id);
//        die();


    }


}