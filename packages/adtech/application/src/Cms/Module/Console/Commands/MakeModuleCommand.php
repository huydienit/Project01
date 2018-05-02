<?php

namespace Adtech\Application\Cms\Module\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class MakeRepositoryCommand
 *
 * @package Adtech\Application\Cms\Module\Console\Commands
 */
class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module structure';

    /**
     * @var
     */
    protected $composer;

    public function __construct()
    {
        parent::__construct();

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
        $this->writeModule($arguments, $options);

        // Dump autoload.
        $this->composer->dumpAutoloads();
    }

    /**
     * Write the criteria.
     *
     * @param $arguments
     * @param $options
     */
    public function writeModule($arguments, $options)
    {
        // Set module.
        $module = ucfirst($arguments['module']);

        // Set model.
        $model = $options['model'];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'The module name.']
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
        ];
    }
}
