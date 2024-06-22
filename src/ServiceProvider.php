<?php

namespace Admin\Extend\AdminUsers;

use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminUsers\Extension\Config;
use Admin\Extend\AdminUsers\Extension\Install;
use Admin\Extend\AdminUsers\Extension\Navigator;
use Admin\Extend\AdminUsers\Extension\Uninstall;
use Exception;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminUsers
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static string $name = "bfg/admin-users";

    /**
     * Extension call slug
     * @var string
     */
    static string $slug = "bfg_admin_users";

    /**
     * Extension description
     * @var string
     */
    public static string $description = "Bfg admin users for uaers control";

    /**
     * @var string
     */
    protected string $navigator = Navigator::class;

    /**
     * @var string
     */
    protected string $install = Install::class;

    /**
     * @var string
     */
    protected string $uninstall = Uninstall::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected string|ConfigExtensionProvider $config = Config::class;

    /**
     * @return void
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        /**
         * Register publishers lang.
         */
        $this->publishes([
            __DIR__.'/../translations/en' => lang_path('en'),
            __DIR__.'/../translations/ru' => lang_path('ru'),
            __DIR__.'/../translations/uk' => lang_path('uk'),
        ], ['admin-users-lang']);
    }
}

