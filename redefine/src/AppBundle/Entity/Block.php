<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Block
 *
 * @ORM\Table(name="block")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlockRepository")
 */
class Block
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="BlockData", mappedBy="block")
     */
    private $block_datas;

    /**
     * @ORM\ManyToMany(targetEntity="TemplateSlot", inversedBy="blocks")
     * @ORM\JoinTable(name="templateslots_blocks")
     */
    private $template_slots;

    public function __construct() {
        $this->block_datas = new ArrayCollection();
        $this->template_slots = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Block
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Block
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add blockData
     *
     * @param \AppBundle\Entity\BlockData $blockData
     *
     * @return Block
     */
    public function addBlockData(\AppBundle\Entity\BlockData $blockData)
    {
        $this->block_datas[] = $blockData;

        return $this;
    }

    /**
     * Remove blockData
     *
     * @param \AppBundle\Entity\BlockData $blockData
     */
    public function removeBlockData(\AppBundle\Entity\BlockData $blockData)
    {
        $this->block_datas->removeElement($blockData);
    }

    /**
     * Get blockDatas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlockDatas()
    {
        return $this->block_datas;
    }

    /**
     * Add templateSlot
     *
     * @param \AppBundle\Entity\TemaplteSlot $templateSlot
     *
     * @return Block
     */
    public function addTemplateSlot(\AppBundle\Entity\TemaplteSlot $templateSlot)
    {
        $this->template_slots[] = $templateSlot;

        return $this;
    }

    /**
     * Remove templateSlot
     *
     * @param \AppBundle\Entity\TemaplteSlot $templateSlot
     */
    public function removeTemplateSlot(\AppBundle\Entity\TemaplteSlot $templateSlot)
    {
        $this->template_slots->removeElement($templateSlot);
    }

    /**
     * Get templateSlots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplateSlots()
    {
        return $this->template_slots;
    }
}
