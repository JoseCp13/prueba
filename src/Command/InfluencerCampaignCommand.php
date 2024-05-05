<?php

namespace App\Command;

use App\Entity\campaignInfluencer;
use App\Entity\campaigns;
use App\Entity\influencers;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:influencers-campaign'
)]
class InfluencerCampaignCommand extends Command
{protected static $defaultName = 'app:assign-influencer';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Assigns an influencer to a campaign.')
            ->setHelp('This command allows you to assign an influencer to a campaign.')
            ->addArgument('campaignsId', InputArgument::REQUIRED, 'The ID of the campaign.')
            ->addArgument('influencersId', InputArgument::REQUIRED, 'The ID of the influencer.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $campaignsId = $input->getArgument('campaignsId');
        $influencersId = $input->getArgument('influencersId');

        $campaigns = $this->entityManager->getRepository(campaigns::class)->find($campaignsId);
        $influencers = $this->entityManager->getRepository(influencers::class)->find($influencersId);

        if (!$campaigns || !$influencers) {
            $output->writeln('Campaign or influencer not found.');
            return Command::FAILURE;
        }

        $campaignInfluencer = new campaignInfluencer();
        $campaignInfluencer->setCampaigns($campaigns);
        $campaignInfluencer->setInfluencers($influencers);

        $this->entityManager->persist($campaignInfluencer);
        $this->entityManager->flush();

        $output->writeln('Influencer assigned to campaign successfully.');
        $output->writeln(sprintf('Influencer: %s, Campaign: %s', $influencers->getName(), $campaigns->getName()));

        return Command::SUCCESS;
    }
}
