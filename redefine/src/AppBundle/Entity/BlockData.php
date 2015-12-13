<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockData
 *
 * @ORM\Table(name="block_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlockDataRepository")
 */
class BlockData
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
     * @ORM\ManyToOne(targetEntity="CV", inversedBy="block_datas")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cv;

    /**
     * @ORM\ManyToOne(targetEntity="TemplateSlot", inversedBy="block_datas")
     * @ORM\JoinColumn(name="template_slot_id", referencedColumnName="id")
     */
    private $template_slot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;


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
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return BlockData
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set cv
     *
     * @param \AppBundle\Entity\CV $cv
     *
     * @return BlockData
     */
    public function setCv(\AppBundle\Entity\CV $cv = null)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return \AppBundle\Entity\CV
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set templateSlot
     *
     * @param \AppBundle\Entity\TemplateSlot $templateSlot
     *
     * @return BlockData
     */
    public function setTemplateSlot(\AppBundle\Entity\TemplateSlot $templateSlot = null)
    {
        $this->template_slot = $templateSlot;

        return $this;
    }

    /**
     * Get templateSlot
     *
     * @return \AppBundle\Entity\TemplateSlot
     */
    public function getTemplateSlot()
    {
        return $this->template_slot;
    }
}
