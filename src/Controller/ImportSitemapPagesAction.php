<?php

namespace Naskruty\DevTestSix\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\WebsiteManager;
use Naskruty\DevTestSix\Component\Import;

/**
 * Class ImportSitemapPagesAction
 * @package Naskruty\DevTestSix\Controller
 */
class ImportSitemapPagesAction
{
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    /**
     * @var Import
     */
    private $import;

    /**
     * ImportSitemapPagesAction constructor.
     * @param UserManager $userManager
     * @param WebsiteManager $websiteManager
     * @param Import $import
     */
    public function __construct(UserManager $userManager, WebsiteManager $websiteManager, Import $import)
    {
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
        $this->import = $import;
    }

    /**
     *
     */
    public function execute()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            return;
        }

        $user = $this->userManager->getByLogin($_SESSION['login']);
        if (!$user) {
            header('Location: /login');
            return;
        }

        $url = $_POST['sitemap_url'];
        if (empty($url)) {
            $_SESSION['flash'] = 'Sitemap URL cannot be empty!';
            header('Location: /import');
            return;
        }

        $res = $this->import->importPages($url, $_SESSION['login']);
        if ($res==true){
            $_SESSION['flash'] = 'Import finished with success!';
            header('Location: /');
            return;
        }

        header('Location: /import');
        return;
    }
}