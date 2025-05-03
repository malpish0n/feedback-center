<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user.',
    aliases: ['app:add:user'],
    hidden: false
)]
class CreateUserCommand extends Command
{
    private bool $requirePassword;

    public function __construct(bool $requirePassword = false)
    {
        $this->requirePassword = $requirePassword;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('username', InputArgument::REQUIRED, 'The email of the user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->write('You are about to ');
        $output->write('create a user.' . PHP_EOL);

        $output->writeln('Username: ' . $input->getArgument('username'));

        return Command::SUCCESS;
    }
}
