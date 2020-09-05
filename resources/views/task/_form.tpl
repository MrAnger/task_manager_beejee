<b-form method="post">
    <b-form-group label="Имя">
        <b-form-input
                trim
                required
                name="Task[username]"
                value="{$model->username}"
                maxlength="100"
        ></b-form-input>
    </b-form-group>

    <b-form-group label="Email">
        <b-form-input
                trim
                required
                type="email"
                name="Task[email]"
                value="{$model->email}"
                maxlength="100"
        ></b-form-input>
    </b-form-group>

    <b-form-group label="Текст задачи">
        <b-form-textarea
                trim
                rows="5"
                required
                name="Task[text]"
                value="{$model->text}"
        ></b-form-textarea>
    </b-form-group>

    {if $user->isAdmin}
        <div class="form-group">
            <input type="hidden" name="Task[is_completed]" value="0">
            <b-form-checkbox
                    name="Task[is_completed]"
                    value="1"
                    unchecked-value="0"
                    checked="{$model->is_completed}"
            >
                Выполнено
            </b-form-checkbox>
        </div>
    {/if}

    <b-button type="submit" variant="primary">Сохранить</b-button>
</b-form>