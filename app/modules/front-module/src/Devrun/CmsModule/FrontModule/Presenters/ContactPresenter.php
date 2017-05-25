<?php
/**
 * This file is part of devrun.
 * Copyright (c) 2017
 *
 * @file    ContactPresenter.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace Devrun\CmsModule\FrontModule\Presenters;

use Devrun\CmsModule\FrontModule\Controls\IContactGridControlFactory;
use Devrun\CmsModule\Presenters\AdminPresenter;
use FrontModule\Repositories\ContactRepository;

class ContactPresenter extends AdminPresenter
{

    /** @var ContactRepository @inject */
    public $contactRepository;

    /** @var IContactGridControlFactory @inject */
    public $contactGridControlFactory;


    public function handleDelete($id)
    {

    }


    protected function createComponentGrid($name)
    {
        $grid = $this->createGrid($name);

        $repository = $this->contactRepository;
        $model      = new \Grido\DataSources\Doctrine(
            $repository->createQueryBuilder('a')

        );

        $grid->model = $model;

        $grid->addColumnText('name', 'Jméno příjmení')
            ->setSortable()
            ->setFilterText();

        $grid->addColumnText('mail', 'e-mail')
            ->setSortable()
            ->setFilterText();

        $grid->addColumnText('title', 'předmět')
            ->setSortable()
            ->setFilterText();

        $grid->addColumnText('text', 'Obsah')
            ->setSortable()
            ->setFilterText();


        $grid->addActionHref('delete', 'Smazat', 'delete!')
            ->setIcon('trash fa-2x')
            ->setConfirm(function ($item) {
                return "Opravdu chcete smazat článek {$item->id}?";
            })
            ->getElementPrototype()->addAttributes(array(
                'class' => 'ajax',
            ));


        return $grid;
    }


    protected function createComponentContactGrid()
    {
        $control = $this->contactGridControlFactory->create();

        return $control;
    }


}