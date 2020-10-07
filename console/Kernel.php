<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class Kernel extends Command
{
    protected static $defaultName = 'schedule:run';
    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Schedule run')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command is needed for the automation.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command

        $daily_tasks = Cron\CronExpression::factory('@daily');
        if ($daily_tasks->isDue()) {
            $output->writeln('Generating invoice...');
        }

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
