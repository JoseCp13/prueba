<?php

// src/Entity/CampaignInfluencer.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "campaign_influencer")]
class campaignInfluencer
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity: "App\Entity\campaigns")]
    #[ORM\JoinColumn(name: "campaigns_id", referencedColumnName: "id",nullable: false)]

    private $campaigns;

    #[ORM\ManyToOne(targetEntity: "App\Entity\influencers")]
    #[ORM\JoinColumn(name: "influencers_id", referencedColumnName: "id",nullable: false)]
    private $influencers;

    // Getters y setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampaigns(): ?campaigns
    {
        return $this->campaigns;
    }

    public function setCampaigns(?campaigns $campaigns): self
    {
        $this->campaigns = $campaigns;
        return $this;
    }

    public function getInfluencers(): ?influencers
    {
        return $this->influencers;
    }

    public function setInfluencers(?influencers $influencers): self
    {
        $this->influencers = $influencers;
        return $this;
    }
}
