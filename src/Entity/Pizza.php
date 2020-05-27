<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pizza")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @var int
     * @ORM\Column(name="id_pizza", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var Collection
     */
    private $quantiteIngredients;

    /**
     * @ORM\OneToMany(targetEntity=IngredientPizza::class, mappedBy="pizza")
     */
    private $ingredientsPizza;

    /**
     * @ORM\ManyToMany(targetEntity=Pizzeria::class, inversedBy="pizzas")
     */
    private $pizzeria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quantiteIngredients = new ArrayCollection();
        $this->ingredientsPizza = new ArrayCollection();
        $this->pizzeria = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pizza
     */
    public function setId(int $id): Pizza
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Pizza
     */
    public function setNom(string $nom): Pizza
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     * @return Pizza
     */
    public function addQuantiteIngredients(IngredientPizza $quantiteIngredients): Pizza
    {
        $this->quantiteIngredients[] = $quantiteIngredients;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     */
    public function removeQuantiteIngredient(IngredientPizza $quantiteIngredients): void
    {
        $this->quantiteIngredients->removeElement($quantiteIngredients);
    }

    /**
     * @return Collection
     */
    public function getQuantiteIngredients(): Collection
    {
        return $this->quantiteIngredients;
    }

    /**
     * @return Collection|IngredientPizza[]
     */
    public function getIngredientsPizza(): Collection
    {
        return $this->ingredientsPizza;
    }

    public function addIngredientsPizza(IngredientPizza $ingredientsPizza): self
    {
        if (!$this->ingredientsPizza->contains($ingredientsPizza)) {
            $this->ingredientsPizza[] = $ingredientsPizza;
            $ingredientsPizza->setPizza($this);
        }

        return $this;
    }

    public function removeIngredientsPizza(IngredientPizza $ingredientsPizza): self
    {
        if ($this->ingredientsPizza->contains($ingredientsPizza)) {
            $this->ingredientsPizza->removeElement($ingredientsPizza);
            // set the owning side to null (unless already changed)
            if ($ingredientsPizza->getPizza() === $this) {
                $ingredientsPizza->setPizza(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pizzeria[]
     */
    public function getPizzeria(): Collection
    {
        return $this->pizzeria;
    }

    public function addPizzerium(Pizzeria $pizzerium): self
    {
        if (!$this->pizzeria->contains($pizzerium)) {
            $this->pizzeria[] = $pizzerium;
        }

        return $this;
    }

    public function removePizzerium(Pizzeria $pizzerium): self
    {
        if ($this->pizzeria->contains($pizzerium)) {
            $this->pizzeria->removeElement($pizzerium);
        }

        return $this;
    }
}
