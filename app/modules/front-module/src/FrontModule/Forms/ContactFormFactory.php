<?php
/**
 * This file is part of the devrun
 * Copyright (c) 2017
 *
 * @file    ContactFormFactory.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace FrontModule\Forms;

use Devrun\CmsModule\Forms\DevrunFormFactory;
use Nette\Application\UI\Form;
use Nette\Object;

/**
 * Class ContactFormFactory
 *
 * @package FrontModule\Forms
 */
class ContactFormFactory extends Object
{

    /** @var DevrunFormFactory */
    private $factory;

    /**
     * ContactFormFactory constructor.
     *
     * @param DevrunFormFactory $factory
     */
    public function __construct(DevrunFormFactory $factory)
    {
        $this->factory = $factory;
    }


    /**
     * @return \Devrun\CmsModule\Forms\DevrunForm
     */
    function create()
    {
        $form = $this->factory->create()->bootstrap3Render();


        $form->addText('name', 'Jméno a příjmení')
            ->setAttribute('placeholder', "jméno a příjmení")
            ->addRule(Form::FILLED);

        $form->addText('mail', 'e-mail')
            ->setAttribute('placeholder', "e-mail")
            ->addRule(Form::FILLED, 'vyplňte položku prosím')
            ->addRule(Form::EMAIL);

        $form->addText('title', 'předmět')
            ->setAttribute('placeholder', "předmět")
            ->addRule(Form::FILLED);

        $form->addTextArea('text', 'Zpráva')
            ->setAttribute('placeholder', "krátký popis článku")
            ->addRule(Form::FILLED);


        $form->addSubmit('send', 'Upravit');
//        $this->addFormClass(['ajax']);

        return $form;
    }


}