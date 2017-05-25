<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12.4.17
 * Time: 17:33
 */

namespace FrontModule\Presenters;

use Devrun\Application\UI\Presenter\BasePresenter;
use Devrun\CmsModule\Presenters\CmsPresenterTrait;
use Devrun\Doctrine\DoctrineForms\EntityFormMapper;
use FrontModule\Entities\ContactEntity;
use FrontModule\Forms\ContactFormFactory;

class ContactPresenter extends BasePresenter
{
    use CmsPresenterTrait;

    /** @var ContactFormFactory @inject */
    public $contactFormFactory;


    /** @var EntityFormMapper @inject */
    public $entityMapper;


    public function renderDefault()
    {
//        dump($this->imgPipe);
//        die();



    }


    /**
     * @return \Devrun\CmsModule\Forms\DevrunForm
     */
    protected function createComponentContactForm()
    {
        $form = $this->contactFormFactory->create();

        $entity = new ContactEntity();


        $form->injectEntityMapper($this->entityMapper);

        $form->bindEntity($entity);


        $form->onSuccess[] = function ($form) {

            if ($entity = $form->getEntity()) {
                $this->entityMapper->getEntityManager()->persist($entity)->flush();
                $this->flashMessage('Děkujeme za zprávu');
                $this->ajaxRedirect();
            }


        };

        return $form;
    }


}