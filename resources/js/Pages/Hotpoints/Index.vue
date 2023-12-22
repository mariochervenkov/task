<template>
    <App>
        <v-container>
            <v-alert v-if="$page.props.flash.success_message" type="success" variant="outlined" class="mb-5">
                {{ $page.props.flash.success_message }}
            </v-alert>

            <v-alert v-if="$page.props.flash.error_message" type="error" variant="outlined" class="mb-5">
                {{ $page.props.flash.error_message }}
            </v-alert>

            <v-card class="pa-4">
                <v-btn @click="create" color="green" width="auto" class="mb-2">
                    Create Hotpoint
                </v-btn>
                <v-data-table :headers="headers" :items="hotpoints">
                    <template v-slot:item.actions="{ item }">
                        <div class="d-flex">
                            <v-btn class="me-2" @click="edit(item.id)" color="blue" text="Edit"></v-btn>
                            <v-btn color="red" @click="destroy(item.id)" text="Delete"></v-btn>
                        </div>
                    </template>
                </v-data-table>
            </v-card>
        </v-container>


        <v-dialog v-model="open_dialog" max-width="500px">
            <v-card title="Delete Hotpoint">
                <v-card-text>
                    Are you sure?
                </v-card-text>

                <v-card-actions class="justify-content-between">
                    <v-btn
                        text="Close"
                        @click="open_dialog = false"
                    ></v-btn>
                    <v-btn
                        text="Delete"
                        color="green"
                        @click="confirmDestroy"
                    ></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </App>
</template>

<script>
import App from "../../Layouts/App.vue"
import {router} from "@inertiajs/vue3";

export default {
    components: {App},
    props: {
        hotpoints:{type:Array},
    },
    data: () => ({
        open_dialog: false,
        headers: [
            { title: 'Name',  align: 'start',  sortable: true,  key: 'name'},
            { title: 'Position X (px)',  align: 'start',  sortable: true,  key: 'position_x'},
            { title: 'Position Y (px)',  align: 'start',  sortable: true,  key: 'position_y'},
            { title: 'Product',  align: 'start',  sortable: true,  key: 'product.name'},
            { title: 'Activity',  align: 'start',  sortable: true,  key: 'activity'},
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        delete_item_id: null
    }),
    methods: {
        create() {
            router.get(route('hotpoints.create'));
        },
        edit(itemId) {
            router.get(route('hotpoints.edit', itemId));
        },
        destroy(itemId) {
            this.delete_item_id = itemId;
            this.open_dialog = true;
        },
        confirmDestroy() {
            router.delete(route('hotpoints.destroy', this.delete_item_id));
            this.open_dialog = false;
        }
    }
}

</script>

<style scoped>

</style>
