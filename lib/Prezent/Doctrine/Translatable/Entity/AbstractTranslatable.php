<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\Doctrine\Translatable\Entity;

use Doctrine\ORM\Mapping as ORM;
use Prezent\Doctrine\Translatable\Annotation as Prezent;
use Prezent\Doctrine\Translatable\Translatable;
use Prezent\Doctrine\Translatable\Translation;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractTranslatable implements Translatable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * Mapping provided by implementation
     */
    protected $translations;

    /**
     * Get the translations
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
    
    /**
     * Add a translation
     *
     * @param Translation $translation
     * @return self
     */
    public function addTranslation(Translation $translation)
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setTranslatable($this);
        }
    
        return $this;
    }
    
    /**
     * Remove a translation
     *
     * @param Translation $translation
     * @return self
     */
    public function removeTranslation(Translation $translation)
    {
        if ($this->translations->removeElement($translation)) {
            $translation->setTranslatable(null);
        }
    
        return $this;
    }
}
