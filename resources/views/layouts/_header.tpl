<b-navbar toggleable="lg" type="dark" variant="dark">
    <b-navbar-brand href="{$router->homeUrl()}">
        Task Manager
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <b-nav-item href="{$router->createUrl('task', 'create')}">
                Добавить задачу
            </b-nav-item>
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right>
                <template v-slot:button-content>
                    {if $user->isAuth()}
                        <em>{$user->username}</em>
                    {else}
                        <em>Гость</em>
                    {/if}
                </template>

                {if $user->isAuth()}
                    <b-dropdown-item href="{$router->createUrl('user', 'logout')}">
                        Выйти
                    </b-dropdown-item>
                {else}
                    <b-dropdown-item href="{$router->createUrl('user', 'login')}">
                        Войти
                    </b-dropdown-item>
                {/if}
            </b-nav-item-dropdown>
        </b-navbar-nav>
    </b-collapse>
</b-navbar>