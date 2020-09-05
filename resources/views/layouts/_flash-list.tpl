{foreach $session->getAllFlashes() as $type => $data}
    {if is_array($data)}
        {foreach $data as $message}
            <b-alert
                    variant="{$type}"
                    dismissible
                    show
            >{$message}
            </b-alert>
        {/foreach}
    {else}
        <b-alert
                variant="{$type}"
                dismissible
                show
        >{$data}
        </b-alert>
    {/if}

    {$session->removeFlash($type)}
{/foreach}