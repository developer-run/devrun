<?php
/**
 * This file is part of the devrun2016
 * Copyright (c) 2016
 *
 * @file    FrontExtension.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace FrontModule\DI;

use Devrun\Config\CompilerExtension;
use Flame\Modules\Providers\IPresenterMappingProvider;
use Flame\Modules\Providers\IRouterProvider;
use Kdyby\Doctrine\DI\IEntityProvider;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\DI\ContainerBuilder;

class FrontExtension extends CompilerExtension implements IPresenterMappingProvider, IRouterProvider, IEntityProvider
{

    public $defaults = array(
        'publicModule' => TRUE,

    );


    public function loadConfiguration()
    {
        parent::loadConfiguration();

        /** @var ContainerBuilder $builder */
        $builder = $this->getContainerBuilder();
        $config  = $this->getConfig($this->defaults);

        $this->compiler->parseServices(
            $this->getContainerBuilder(),
            $this->loadFromFile(dirname(dirname(dirname(__DIR__))) . "/resources/config/config.neon")
        );


        $builder->addDefinition($this->prefix('repository.contactRepository'))
            ->setClass('FrontModule\Repositories\ContactRepository');


        $lateFactory = $builder->getDefinition('nette.latteFactory');








//        dump($this->name);

//        dump($builder);
//        die();


    }


    /**
     * Returns array of ClassNameMask => PresenterNameMask
     *
     * @example return array('*' => 'Booking\*Module\Presenters\*Presenter');
     * @return array
     */
    public function getPresenterMapping()
    {
        return array(
            'Front' => 'FrontModule\*Module\Presenters\*Presenter',
        );
    }

    /**
     * Returns array of ServiceDefinition,
     * that will be appended to setup of router service
     *
     * @example https://github.com/nette/sandbox/blob/master/app/router/RouterFactory.php - createRouter()
     * @return \Nette\Application\IRouter
     */
    public function getRoutesDefinition()
    {
        $routeList     = new RouteList();
        $routeList[]   = $frontRouter = new RouteList('Front');
        $frontRouter[] = new Route('sitemap.xml', array('presenter' => 'Sitemap', 'action' => 'sitemap',));
        $frontRouter[] = new Route('[<locale=cs sk|en|cs>/]<presenter>/<action>[/<id>]', array(
            'presenter' => array(
                Route::VALUE        => 'Homepage',
                Route::FILTER_TABLE => array(),
            ),
            'action'    => array(
                Route::VALUE        => 'default',
                Route::FILTER_TABLE => array(
                    'operace-ok' => 'operationSuccess',
                ),
            ),
            'id'        => null,
            'locale' => [
                Route::FILTER_TABLE => [
                    'cz' => 'cs',
                    'sk' => 'sk',
                    'pl' => 'pl',
                    'com' => 'en'
                ]]
        ));
        return $routeList;

    }


    /**
     * Returns associative array of Namespace => mapping definition
     *
     * @return array
     */
    function getEntityMappings()
    {
        return array(
            'FrontModule' => dirname(__DIR__) . '/Entities/*Entity.php',
        );
    }

}