<?php

namespace App\Command;

use App\Entity\campaigns;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;


#[AsCommand(
    name: 'app:list-campaign',
)]
class ListCampaignCommand extends Command
{
    protected static $defaultName = 'app:list-campaigns';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Lists all campaigns.')
            ->setHelp('This command allows you to list all campaigns.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $campaigns = $this->entityManager->getRepository(campaigns::class)->findAll();

        if (!$campaigns) {
            $output->writeln('No campaigns found.');
            return Command::SUCCESS;
        }

        foreach ($campaigns as $campaign) {
            $output->writeln([
                'Name: ' . $campaign->getName(),
                'Description: ' . $campaign->getDescription(),
                'Start Date: ' . $campaign->getStartDate()->format('Y-m-d H:i:s'),
                'End Date: ' . $campaign->getEndDate()->format('Y-m-d H:i:s'),
                '----------------------------------------',
            ]);
        }

        return Command::SUCCESS;
    }
}
