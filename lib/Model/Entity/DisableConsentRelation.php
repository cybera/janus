<?php

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *  name="disableConsent"
 * )
 */
class sspmod_janus_Model_Entity_DisableConsentRelation
{
    /**
     * NOTE: Just here for Doctrine requires a Primary key, just $entity instead
     *
     * @ORM\Id
     * @ORM\Column(name="eid", type="integer")
     */
    protected $entityId;

    /**
     * NOTE: Just here for Doctrine requires a Primary key, just $entity instead
     *
     * @ORM\Id
     * @ORM\Column(name="revisionid", type="integer")
     */
    protected $entityRevisionNr;

    /**
     * @var sspmod_janus_Model_Entity
     *
     * @ORM\ManyToOne(targetEntity="sspmod_janus_Model_Entity")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="eid", referencedColumnName="eid"),
     *      @ORM\JoinColumn(name="revisionid", referencedColumnName="revisionid")
     * })
     */
    protected $entity;

    /**
     * @var string
     *
     * @ORM\Column(name="remoteentityid", type="text")
     * @todo this should be converted to remoteEntityEid and be part of the primary key
     *  see: https://github.com/janus-ssp/janus/issues/389
     */
    protected $remoteEntityEntityId;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="janusDateTime")
     */
    protected $createdAtDate;

    /**
     * @var sspmod_janus_Model_Ip
     *
     * @ORM\Column(name="ip", type="janusIp")
     */
    protected $updatedFromIp;

    /**
     * @param sspmod_janus_Model_Entity $entity
     * @param sspmod_janus_Model_Entity $remoteEntity
     */
    public function __construct(
        sspmod_janus_Model_Entity $entity,
        sspmod_janus_Model_Entity $remoteEntity
    ) {
        $this->entity = $entity;
        $this->entityId = $entity->getId();
        $this->entityRevisionNr = $entity->getRevisionNr();
        $this->remoteEntityEntityId = $remoteEntity->getEntityId();
    }

    /**
     * @param \DateTime $createdAtDate
     * @return $this
     */
    public function setCreatedAtDate(DateTime $createdAtDate)
    {
        $this->createdAtDate = $createdAtDate;
        return $this;
    }

    /**
     * @param sspmod_janus_Model_Ip $updatedFromIp
     * @return $this
     */
    public function setUpdatedFromIp(sspmod_janus_Model_Ip $updatedFromIp)
    {
        $this->updatedFromIp = $updatedFromIp;
        return $this;
    }
}