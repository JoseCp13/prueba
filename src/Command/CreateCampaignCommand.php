<?php
// src/Command/CreateCampaignCommand.php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Attribute\AsCommand;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\campaigns;

#[AsCommand(name: 'app:create-campaign')]
class CreateCampaignCommand extends Command
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new campaign.')
            ->setHelp('This command allows you to create a new campaign.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        // Solicitar al usuario los detalles de la campaña
        $nameQuestion = new Question('Enter the name of the campaign: ');
        $name = $helper->ask($input, $output, $nameQuestion);

        $descriptionQuestion = new Question('Enter the description of the campaign: ');
        $description = $helper->ask($input, $output, $descriptionQuestion);

        $startDateQuestion = new Question('Enter the start date of the campaign (YYYY-MM-DD HH:MM:SS): ');
        $startDate = new \DateTime($helper->ask($input, $output, $startDateQuestion));

        $endDateQuestion = new Question('Enter the end date of the campaign (YYYY-MM-DD HH:MM:SS): ');
        $endDate = new \DateTime($helper->ask($input, $output, $endDateQuestion));

        // Crear una nueva instancia de la entidad Campaign y asignar los valores
        $campaign = new campaigns();
        $campaign->setName($name);
        $campaign->setDescription($description);
        $campaign->setStartDate($startDate);
        $campaign->setEndDate($endDate);

        // Guardar la nueva campaña en la base de datos
        $this->entityManager->persist($campaign);
        $this->entityManager->flush();

        $output->writeln('Campaign created successfully.');

        return Command::SUCCESS;
    }
}
