<?php

namespace Naskruty\DevTestSix\Command;

use Naskruty\DevTestSix\Component\Import;
use Snowdog\DevTest\Model\UserManager;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand
{
    /**
     * @var Import
     */
    private $import;

    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(Import $import, UserManager $userManager)
    {
        $this->userManager = $userManager;
        $this->import = $import;
    }

    public function __invoke($url, $userLogin, OutputInterface $output)
    {
        if (empty($url)) {
            $output->writeln('<error>Sitemap URL cannot be empty!</error>');
            return;
        }

        if (empty($userLogin)) {
            $output->writeln('<error>User login cannot be empty!</error>');
            return;
        }
        $user = $this->userManager->getByLogin($userLogin);
        if (!$user) {
            $output->writeln('<error>User with login '. $userLogin . ' does not exist!</error>');
            return;
        }

        $res = $this->import->importPages($url, $userLogin);
        if ($res==true){
            $output->writeln('Import finished with success!');
        }

        return;
    }
}