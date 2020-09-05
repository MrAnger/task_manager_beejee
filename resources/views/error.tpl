{extends file="layouts\main.tpl"}

{block name=body}
    <div>
        <h1>Ошибка!</h1>

        <p>
            <code>
                {$exception->getMessage()}
            </code>
        </p>
    </div>
{/block}