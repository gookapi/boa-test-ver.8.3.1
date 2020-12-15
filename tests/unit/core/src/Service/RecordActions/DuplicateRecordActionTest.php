<?php

namespace App\Tests\unit\core\src\Service\RecordActions;

use App\Entity\Process;
use App\Legacy\ModuleNameMapperHandler;
use App\Service\RecordActions\DuplicateRecordAction;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;

/**
 * Class DuplicateRecordActionTest
 * @package App\Tests
 */
class DuplicateRecordActionTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @var DuplicateRecordAction
     */
    protected $service;

    /**
     * @throws Exception
     */
    protected function _before(): void
    {

        $moduleNameMapper = new ModuleNameMapperHandler(
            $this->tester->getProjectDir(),
            $this->tester->getLegacyDir(),
            $this->tester->getLegacySessionName(),
            $this->tester->getDefaultSessionName(),
            $this->tester->getLegacyScope()
        );

        $this->service = new DuplicateRecordAction(
            $moduleNameMapper
        );
    }

    /**
     * Test Duplicate redirect Info
     */
    public function testDuplicateRedirectInfo(): void
    {
        $process = new Process();
        $process->setType('record-duplicate');
        $process->setOptions([
            'action' => 'record-duplicate',
            'id' => 'e24be4e0-4424-9728-9294-5ea315eef53e',
            'module' => 'contacts'
        ]);

        $this->service->run($process);

        static::assertSame([
            'handler' => 'redirect',
            'params' => [
                'route' => 'contacts/duplicate/e24be4e0-4424-9728-9294-5ea315eef53e',
                'queryParams' => [
                    'isDuplicate' => true,
                    'return_module' => 'Contacts',
                    'return_action' => 'DetailView',
                    'return_id' => 'e24be4e0-4424-9728-9294-5ea315eef53e',
                ]
            ]
        ], $process->getData());

        static::assertEquals('success', $process->getStatus());
        static::assertSame([], $process->getMessages());
    }
}