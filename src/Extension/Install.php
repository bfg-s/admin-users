<?php

namespace Admin\Extend\AdminUsers\Extension;

use Admin\Core\InstallExtensionProvider;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Install
 * @package Admin\Extend\AdminUsers\Extension
 */
class Install extends InstallExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->command->call('vendor:publish', [
            '--tag' => "admin-users-lang",
            '--force' => true,
        ]);
    }
}
