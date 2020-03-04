<?php

namespace Naskruty\DevTestSix\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;

class SitemapPagesAction
{
    /**
     * @var User
     */
    private $user;

    public function __construct(UserManager $userManager)
    {
        if (isset($_SESSION['login'])) {
            $this->user = $userManager->getByLogin($_SESSION['login']);
        }
    }

    public function execute()
    {
        require __DIR__ . '/../view/sitemap.phtml';
    }
}