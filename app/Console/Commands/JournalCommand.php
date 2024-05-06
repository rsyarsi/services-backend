<?php

namespace App\Console\Commands;

use App\Services\Finance\JournalService;
use Illuminate\Console\Command;

class JournalCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "cronjob:service_finance:journal";

    /**
     * @var string
     */
    protected $description = "Run journal command";

    /**
     * @var \App\Services\Finance\JournalService
     */
    protected $service;

    /**
     * @param \App\Services\Finance\JournalService $service
     * @return void
     */
    public function __construct(JournalService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @return int
     */
    public function handle()
    {
        $this->service->execute();

        $this->info("Journal executed successfully.");

        return 0;
    }
};