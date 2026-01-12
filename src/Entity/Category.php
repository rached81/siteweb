<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $alias;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="category")
     */

    /**
     * Profils liés à la catégorie (ManyToMany correct ↔ Profile#categories)
     * @ORM\ManyToMany(targetEntity=Profile::class, inversedBy="categories")
     * @ORM\JoinTable(name="profile_category")  // adapte au nom **existant** si tu as déjà une table de jonction
     */
    private Collection $profiles;
    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="category")
     * @var Collection<int, Article>
     */
    private Collection $articles;

      /**
     * @ORM\OneToMany(targetEntity=TimeLine::class, mappedBy="category")
     */
    private $timeLines;


   

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->timeLines = new ArrayCollection();
        $this->profiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCategory($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory(null);
            }
        }

        return $this;
    }


    /** @return Collection<int, Profile> */
    public function getProfiles(): Collection { return $this->profiles; }

    public function addProfile(Profile $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles->add($profile);
            $profile->addCategory($this); // maintient la relation côté inverse
        }
        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            $profile->removeCategory($this);
        }
        return $this;
    }


    /**
     * @return Collection<int, TimeLine>
     */
    public function getTimeLines(): Collection
    {
        return $this->timeLines;
    }

    public function addTimeLine(TimeLine $timeLine): self
    {
        if (!$this->timeLines->contains($timeLine)) {
            $this->timeLines[] = $timeLine;
            $timeLine->setCategory($this);
        }

        return $this;
    }

    public function removeTimeLine(TimeLine $timeLine): self
    {
        if ($this->timeLines->removeElement($timeLine)) {
            // set the owning side to null (unless already changed)
            if ($timeLine->getCategory() === $this) {
                $timeLine->setCategory(null);
            }
        }

        return $this;
    }


}
