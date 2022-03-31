<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $michel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMichel(): ?string
    {
        return $this->michel;
    }

    public function setMichel(string $michel): self
    {
        $this->michel = $michel;

        return $this;
    }
}
