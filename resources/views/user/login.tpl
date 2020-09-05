{extends file="layouts\main.tpl"}

{block name=body}
    <div class="form-signin">
        <h1>Авторизация</h1>

        <b-form method="post">
            <b-form-group label="Имя">
                <b-form-input
                        trim
                        required
                        name="login"
                        value="{$model->login}"
                        maxlength="100"
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Email">
                <b-form-input
                        trim
                        required
                        type="password"
                        name="password"
                        value="{$model->password}"
                        maxlength="100"
                ></b-form-input>
            </b-form-group>

            {if $model->error !== null}
                <b-alert variant="danger" show>{$model->error}</b-alert>
            {/if}

            <b-button type="submit" variant="primary">Войти</b-button>
        </b-form>
    </div>
{/block}
