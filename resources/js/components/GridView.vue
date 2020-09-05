<template>
    <div>
        <b-table
                :fields="columns"
                :items="models"
                responsive="sm"
                show-empty
                emptyText="Список пуст"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :no-local-sorting="true"
                @sort-changed="onSortChange"
        >
            <template v-slot:table-colgroup="scope">
                <col
                        v-for="field in scope.fields"
                        :key="field.key"
                        :style="field.style"
                >
            </template>

            <template v-slot:cell(text)="data">
                <div v-html="nl2br(data.item.text)"></div>
            </template>

            <template v-slot:cell(is_completed)="data">
                <span v-if="data.item.is_completed" class="badge badge-success">
                    Выполнено
                </span>
                <span v-if="!data.item.is_completed" class="badge badge-danger">
                    Не выполнено
                </span>

                <span v-if="data.item.is_updated_by_admin" class="badge badge-primary">
                    Отредактировано администратором
                </span>
            </template>

            <template v-slot:cell(actions)="data">
                <b-link :href="getUpdateUrl(data.item)">
                    Редактировать
                </b-link>
            </template>
        </b-table>

        <b-pagination
                v-if="total / perPage > 1"
                v-model="currentPage"
                :total-rows="total"
                :per-page="perPage"
                align=right
                @change="onPageChange"
        ></b-pagination>
    </div>
</template>

<script>

    export default {
        props: {
            models: {
                type: Array,
                required: true,
            },
            total: {
                type: Number,
                required: true,
            },
            perPage: {
                type: Number,
                required: true,
            },
            page: {
                type: Number,
                required: true,
            },
            sort: {
                type: String,
                required: true,
            },
            sortDirection: {
                type: String,
                required: true,
            },
            isAdminUser: {
                type: String,
                required: true,
            },
        },

        data() {
            let vm = this;

            return {
                currentPage: vm.page,
                sortBy: vm.sort,
                sortDesc: vm.sortDirection === 'desc',
                columns: [
                    {
                        key: 'username',
                        label: 'Пользователь',
                        sortable: true,
                    },
                    {
                        key: 'email',
                        label: 'Email',
                        sortable: true,
                    },
                    {
                        key: 'text',
                        label: 'Текст задачи',
                        style: {
                            width: '40%',
                        },
                    },
                    {
                        key: 'is_completed',
                        label: 'Статус',
                        sortable: true,
                    },
                ],
            };
        },

        created() {
            if (this.isAdminUser) {
                this.columns.push({
                    key: 'actions',
                    label: 'Действия',
                });
            }
        },

        methods: {
            nl2br(str, is_xhtml) {
                if (typeof str === 'undefined' || str === null) {
                    return '';
                }

                let breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
            },
            getUpdateUrl(item) {
                let url = new URL(location.protocol + "//" + location.host + location.pathname);

                url.searchParams.set('controller', 'task');
                url.searchParams.set('action', 'update');
                url.searchParams.set('id', item.id);

                return url.toString();
            },

            onPageChange(page) {
                let url = new URL(location.href);

                if (page === 1) {
                    url.searchParams.delete('page');
                } else {
                    url.searchParams.set('page', page);
                }

                location.href = url.toString();
            },
            onSortChange(e) {
                let url = new URL(location.href);

                if (!e.sortBy) {
                    url.searchParams.delete('sort');
                    url.searchParams.delete('sort-direction');
                } else {
                    url.searchParams.set('sort', e.sortBy);
                    url.searchParams.set('sort-direction', e.sortDesc ? 'desc' : 'asc');
                }

                location.href = url.toString();
            }
        },
    };
</script>