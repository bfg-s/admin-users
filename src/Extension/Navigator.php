<?php

namespace Admin\Extend\AdminUsers\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminUsers\Controllers\UsersController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminUsers\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $appController = "App\\Admin\\Controllers\\UsersController";

        $this->item('admin-users.users')
            ->resource('users', class_exists($appController) ? $appController : UsersController::class)
            ->icon_users();
    }
}
