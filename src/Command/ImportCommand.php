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

    public function __invoke($url, $user_login, OutputInterface $output)
    {
        if (empty($url)) {
            $output->writeln('<error>Sitemap URL cannot be empty!</error>');
            return;
        }

        if (empty($user_login)) {
            $output->writeln('<error>User login cannot be empty!</error>');
            return;
        }
        $user = $this->userManager->getByLogin($user_login);
        if (!$user) {
            $output->writeln('<error>User with login '. $user_login . ' does not exist!</error>');
            return;
        }

        $res = $this->import->importPages($url, $user_login);
        if (isset($res['status']) and $res['status']=='OK'){
            $message = 'Import finished with success!';
            if (!empty($res['message'])){
                $message = $res['message'];
            }
            $output->writeln($message);
        } else {
            $output->writeln('<error>Something went wrong. Check input data and try again.</error>');
        }

        return;
    }
}