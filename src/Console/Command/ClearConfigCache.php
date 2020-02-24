<?php

declare(strict_types=1);

namespace App\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ClearConfigCache
 *
 * @package App\Console
 */
final class ClearConfigCache extends Command
{
    const ERROR_EXIT_CODE = 1;
    const EXIT_CODE = 0;

    /**
     * @var string|null $path
     */
    private $path;

    /**
     * ClearConfigCache constructor.
     *
     * @param string|null $path
     */
    public function __construct(?string $path)
    {
        $this->path = $path;

        parent::__construct();
    }

    /**
     * configure
     */
    protected function configure(): void
    {
        $this->setName('config:cache:clear');
        $this->setDescription('Clear the config cache.');
        $this->setHelp('Clear any configuration cache.');
    }

    /**
     * execute
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        if (is_null($this->path)) {
            return $this->notConfigured($output);
        }

        if (!file_exists($this->path)) {
            return $this->pathNotFound($output);
        }

        if (unlink($this->path) === false) {
            return $this->removalError($output);
        }

        return $this->removed($output);
    }

    /**
     * noConfigCacheConfig
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function notConfigured(OutputInterface $output): int
    {
        $output->writeln('No configuration cache path configured');

        return self::EXIT_CODE;
    }

    /**
     * configCachePathNotFound
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function pathNotFound(OutputInterface $output): int
    {
        $output->writeln(
            sprintf(
                "Configured config cache file '%s' not found",
                $this->path
            )
        );

        return self::EXIT_CODE;
    }

    /**
     * errorRemovingConfigCache
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function removalError(OutputInterface $output): int
    {
        $output->writeln(
            sprintf("Error removing config cache file '%s'", $this->path)
        );

        return self::ERROR_EXIT_CODE;
    }

    /**
     * removed
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function removed(OutputInterface $output): int
    {
        $output->writeln(
            sprintf("Removed configured config cache file '%s'", $this->path)
        );

        return self::EXIT_CODE;
    }
}
