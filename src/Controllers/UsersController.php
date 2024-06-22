<?php

declare(strict_types=1);

namespace Admin\Extend\AdminUsers\Controllers;

use Admin\Controllers\Controller;
use Admin\Delegates\ModelCards;
use App\Models\User;
use Illuminate\Http\Request;
use Admin\Delegates\Card;
use Admin\Delegates\Form;
use Admin\Delegates\ModelInfoTable;
use Admin\Delegates\ModelTable;
use Admin\Delegates\SearchForm;
use Admin\Delegates\Tab;
use Admin\Page;

class UsersController extends Controller
{
    /**
     * @return string
     */
    public static function getModel(): string
    {
        return config('auth.providers.users.model', User::class);
    }

    /**
     * @param  Page  $page
     * @param  Card  $card
     * @param  SearchForm  $searchForm
     * @param  ModelTable  $modelTable
     * @return Page
     */
    public function index(Page $page, Card $card, SearchForm $searchForm, ModelTable $modelTable): Page
    {
        return $page->card(
            $card->title('admin-users.users'),
            $card->search_form(
                $searchForm->id(),
                $searchForm->input('email', 'admin-users.email')->icon_envelope(),
                $searchForm->input('name', 'admin-users.name'),
                $searchForm->at(),
            ),
            $card->statisticBody(
                $modelTable->id(),
                $modelTable->col('admin-users.email', 'email')->sort()->copied,
                $modelTable->col('admin-users.name', 'name')->sort()->copied,
                $modelTable->at(),
            )
//            $card->model_cards(
//                $modelCards->avatarField('avatar'),
//                $modelCards->titleField('name'),
//                $modelCards->subtitleField('email'),
//                $modelCards->id(),
//                $modelCards->row('admin.role', [$this, 'show_role'])->icon_users(),
//                $modelCards->row('admin.login_name', 'login')->sort()->icon_user(),
//                $modelCards->at(),
//            )
        );
    }

    /**
     * @param  Page  $page
     * @param  Card  $card
     * @param  Form  $form
     * @param  Tab  $tab
     * @return Page
     */
    public function matrix(Page $page, Card $card, Form $form, Tab $tab): Page
    {
        return $page
            ->card(
                $card->title(['admin.add_admin', 'admin.edit_admin']),
                $card->form(
                    $form->tabGeneral(
                        $tab->input('name', 'admin-users.name')
                            ->required()
                            ->is_max_length(191)
                            ->max(191),
                        $tab->input('name', 'admin-users.name')
                            ->required()
                            ->is_max_length(191)
                            ->max(191),
                        $tab->email('email', 'admin-users.email')
                            ->required()
                            ->unique(config('auth.providers.users.model', User::class), 'email', $this->model()->id)
                            ->is_max_length(191)
                            ->max(191),
                    ),
                    $form->tab(
                        $tab->ifEdit()->info_id(),
                        $tab->icon_key()->title('admin-users.password'),
                        $tab->password('password', 'admin-users.new_password')
                            ->confirm()->required_condition($this->isType('create')),
                    ),
                ),
                $card->footer_form(),
            );
    }

    /**
     * @param  Request  $request
     * @param  Page  $page
     * @param  Card  $card
     * @param  ModelInfoTable  $modelInfoTable
     * @return Page
     */
    public function show(
        Request $request,
        Page $page,
        Card $card,
        ModelInfoTable $modelInfoTable,
    ): Page {

        return $page
            ->card(
                $card->model_info_table(
                    $modelInfoTable->id(),
                    $modelInfoTable->row('admin-users.email', 'email'),
                    $modelInfoTable->row('admin-users.name', 'name'),
                    $modelInfoTable->at(),
                )
            );
    }
}
