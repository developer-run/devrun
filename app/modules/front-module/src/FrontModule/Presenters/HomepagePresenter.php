<?php

namespace FrontModule\Presenters;

use Devrun;
use Devrun\Application\UI\Presenter\BasePresenter;
use Devrun\CatalogModule\Presenters\CatalogPresenterTrait;
use Devrun\CmsModule\Presenters\CmsPresenterTrait;

class HomepagePresenter extends BasePresenter
{
	use CmsPresenterTrait;
	use CatalogPresenterTrait;

	/** @var Devrun\ArticleModule\Facades\ArticleFacade @inject */
	public $articleFacade;

	/** @var Devrun\ArticleModule\Repositories\ArticleRepository @inject */
	public $articleRepository;


	public function handleInsertArticle()
	{
        /** @var Devrun\ArticleModule\Entities\ArticleEntity $entity */
        $entity = $this->articleFacade->createNewEntity();

		$entity->setCategories(['homepage', 'default', 'insert']);
		$entity->setContent('Moja kontensa');
		$entity->setDescription('Popis');

		$this->articleFacade->getEntityManager()->persist($entity)->flush();
		$this->redirect('this');
	}

	public function formatTemplateFiles()
	{
		return parent::formatTemplateFiles();
	}


	public function renderWork()
    {

    }


    public function renderAdminDefault()
    {
        $this->setView('default');
        $this->renderDefault();
    }



    public function renderDefault()
	{
//        if (!isset($_SERVER['PHP_AUTH_USER'])) {
//            header('WWW-Authenticate: Basic realm="My Realm"');
//            header('HTTP/1.0 401 Unauthorized');
//            echo 'Text to send if user hits Cancel button';
//            exit;
//        } else {
//            echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
//            echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
//        }


//        $q = new \Devrun\CmsModule\Macros\UICmsMacro();


//	    $this->setLayout(false);

	    $request = $this->getHttpRequest()->getPost('layout');

	    $layout = $this->getParameter('layout');

//	    dump($request);
//	    dump($layout);
//	    dump($_POST);
//	    dump($_REQUEST);
//	    dump($_SERVER);
//	    die();



        $articles = $this->articleRepository->getPageArticles('homepage:default');
        $this->template->articles = $articles;


//        dump($this->productsControl->create());


        return;

		$repo = $this->categoryRepository;

		$first= $repo->findBy(['lvl' => 0]);

		$qb = $repo->createQueryBuilder('a')
            ->where('a.lvl = :level')->setParameter('level', 0)
            ->getQuery()->setMaxResults(1)->getSingleResult();

//		dump($qb->getArrayResult());


		$hierarchie = $repo->childrenHierarchy($qb);

		dump($hierarchie);


		dump($first);
		die();




		$food = $repo->findOneByTitle('Food');
		dump($repo->childCount($food));

//        die();

// prints: 3
		dump($repo->childCount($food, true/*direct*/));

//        die();

// prints: 2
		$children = $repo->children($food);
		dump($children);
//        die();


// $children contains:
// 3 nodes
		$children = $repo->children($food, false, 'title');

		dump($children);
//        die();


// will sort the children by title
		$carrots = $repo->findOneByTitle('Carrots');
		dump($carrots);


		$path    = $repo->getPath($carrots);
		/* $path contains:
           0 => Food
           1 => Vegetables
           2 => Carrots
        */

		dump($path);






		dump($this->articleRepository->findAll());
//		die();





	}



	protected function createComponentArticleControl()
	{
		$control = new Devrun\CmsModule\Controls\ArticleControl();

		return $control;
	}





}
