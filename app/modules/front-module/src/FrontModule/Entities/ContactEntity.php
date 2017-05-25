<?php
/**
 * This file is part of devrun.
 * Copyright (c) 2017
 *
 * @file    ContactEntity.php
 * @author  Pavel Paulík <pavel.paulik@support.etnetera.cz>
 */

namespace FrontModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Devrun\Doctrine\Entities\DateTimeTrait;
use Devrun\Doctrine\Entities\IdentifiedEntityTrait;
use Kdyby\Doctrine\Entities\MagicAccessors;

/**
 * Class ContactEntity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORM\Entity(repositoryClass="FrontModule\Repositories\ContactRepository")
 * @ORM\Table(name="contact")

 * @package FrontModule\Entities
 */
class ContactEntity
{

    use IdentifiedEntityTrait;
    use MagicAccessors;
    use DateTimeTrait;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $mail;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $text;


}