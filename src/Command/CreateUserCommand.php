<?php


namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-user'
,    description: 'Creates a new user.',
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

    // ...
    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Creates a new user.')
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}