<?php
declare(strict_types=1);

namespace Tests\Unit\infrastructure\here;

use Infrastructure\here\HerePort;
use Tests\TestCase;

class HerePortTest extends TestCase
{
    private HerePort $herePort;

    protected function setUp(): void
    {
        parent::setUp();

        $this->herePort = $this->app->get(HerePort::class);
    }

    public function testFindSequence()
    {
        $result = $this->herePort->findSequence(
            'CASA;-31.419209, -62.084702',
            [
                'UCEMED;-31.426832,-62.090919',
                'VIEJA;-31.422564,-62.08762',
                'UTN;-31.420712,-62.109432',
            ],
            'FIN;-31.419209, -62.084702'
        );

        dd($result);
    }
}
