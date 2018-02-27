<?php
declare(strict_types=1);

namespace SystemCtl\Command;

use Symfony\Component\Process\ProcessBuilder;

/**
 * SymfonyCommandDispatcher
 *
 * @package SystemCtl\Command
 * @author  icanhazstring <blubb0r05+github@gmail.com>
 */
class SymfonyCommandDispatcher implements CommandDispatcherInterface
{
    private $binary;
    private $timetout;

    /**
     * @inheritdoc
     */
    public function setBinary(string $binary): CommandDispatcherInterface
    {
        $this->binary = $binary;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTimeout(int $timeout): CommandDispatcherInterface
    {
        $this->timetout = $timeout;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(string ...$commands): CommandInterface
    {
        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix($this->binary);
        $processBuilder->setTimeout($this->timetout);
        $processBuilder->setArguments($commands);

        $process = new SymfonyCommand($processBuilder->getProcess());

        return $process->run();
    }
}
