<?php
/**
 * This file is part of devrun.
 * Copyright (c) 2017
 *
 * @file    ContactGridControl.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace Devrun\CmsModule\FrontModule\Controls;

use Flame\Application\UI\Control;
use FrontModule\Repositories\ContactRepository;
use Grido\Components\Filters\Filter;
use Grido\Grid;
use Nette\Utils\Html;

interface IContactGridControlFactory
{
    /** @return ContactGridControl */
    function create();
}

class ContactGridControl extends Control
{

    /** @var ContactRepository @inject */
    public $contactRepository;


    public function render()
    {
        $template = $this->getTemplate();


        $template->render();
    }


    public function handleDelete($id)
    {
        if ($entity = $this->contactRepository->find($id)) {
            $this->contactRepository->getEntityManager()->remove($entity)->flush();
            $this->flashMessage('Kontakt smazán');
        }

        if ($this->presenter->isAjax()) $this->redrawControl(); $this->redirect('this');
    }



    protected function createComponentGrid()
    {
        $grid                   = new Grid();
        $grid->translator->lang = 'cs';
        $grid->filterRenderType = Filter::RENDER_INNER;
        $grid->setPerPageList([10, 15, 20, 30, 50, 100]);


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


        $grid->addActionHref('delete', 'Smazat')
            ->setIcon('trash fa-2x')
            ->setConfirm(function ($item) {
                return "Opravdu chcete smazat článek {$item->id}?";
            })
            ->setCustomRender(function ($r, Html $h) {
//                dump($r);
//                dump($h);

                $link = $this->link('delete!', ['id' => $r->id]);

//                dump($link);
                $h->href($link);
                return $h;
            })
            ->getElementPrototype()->addAttributes(array(
                'class' => 'ajax',
            ));

        return $grid;

    }


}