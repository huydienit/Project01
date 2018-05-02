<?php

namespace Adtech\Application\Cms\Package\Console\Commands;

use Adtech\Application\Cms\Package\Console\Commands\Creators\PackageCreator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class MakeRepositoryCommand
 *
 * @package Adtech\Application\Cms\Module\Console\Commands
 */
class MakePackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package structure';

    /**
     * @var PackageCreator
     */
    protected $creator;

    /**
     * @var
     */
    protected $composer;

    public function __construct(PackageCreator $creator)
    {
        parent::__construct();

        // Set the creator.
        $this->creator = $creator;

        // Set composer.
        $this->composer = app()['composer'];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the arguments.
        $arguments = $this->argument();

        // Get the options.
        $options = $this->option();

        // Write module.
        $this->writePackage($arguments, $options);

        // Dump autoload.
        $this->composer->dumpAutoloads();
    }

    /**
     * Write the criteria.
     *
     * @param $arguments
     * @param $options
     */
    public function writePackage($arguments, $options)
    {
        // Set module.
        $vendor = $arguments['vendor'];

        $package = $arguments['package'];

        // Create the repository.
        if ($this->creator->create($vendor, $package, $options)) {
            // Information message.
            $this->info("Successfully created the package: <$vendor>/<$package>");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['vendor', InputArgument::REQUIRED, 'The vendor name.'],
            ['package', InputArgument::REQUIRED, 'The package name.']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_OPTIONAL, 'The model name.', null],
            ['repository', null, InputOption::VALUE_OPTIONAL, 'The repository name.', null],
            ['criteria', null, InputOption::VALUE_OPTIONAL, 'The criteria name.', null],
            ['controller', null, InputOption::VALUE_OPTIONAL, 'The controller name.', null],
            ['locale', null, InputOption::VALUE_OPTIONAL, 'The locale name.', null]
        ];
    }
}
