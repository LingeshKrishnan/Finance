<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Authorname;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Article;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $Category;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="article")
     */
 
    private $Contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorname(): ?string
    {
        return $this->Authorname;
    }

    public function setAuthorname(string $Authorname): self
    {
        $this->Authorname = $Authorname;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->Article;
    }

    public function setArticle(string $Article): self
    {
        $this->Article = $Article;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->Contact;
    }

    public function setContact(string $Contact): self
    {
        $this->Contact = $Contact;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
}
