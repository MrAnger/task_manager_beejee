{extends file="layouts\main.tpl"}

{block name=body}
    <h1>Список задач</h1>

    <grid-view
            :models='{$viewModel->getItems()}'
            :total="{$viewModel->total}"
            :per-page="{$viewModel->perPage}"
            :page="{$viewModel->page}"
            sort="{$viewModel->sort}"
            sort-direction="{$viewModel->sortDirection}"
            is-admin-user="{$user->isAdmin}"
    />
{/block}