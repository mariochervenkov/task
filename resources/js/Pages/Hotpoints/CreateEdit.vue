<template>
    <App>
        <v-container>
            <form @submit.prevent="submit">
                <v-text-field
                    label="Name"
                    hide-details="auto"
                    class="mb-3"
                    v-model="form.name"
                ></v-text-field>
                <div class="mb-2 text-danger" v-if="form.errors.name">{{ form.errors.name[0] }}</div>
                <v-text-field
                    type="number"
                    label="Position x (px)"
                    hide-details="auto"
                    class="mb-3"
                    v-model="form.position_x"
                ></v-text-field>
                <div class="mb-2 text-danger" v-if="form.errors.position_x">{{ form.errors.position_x[0] }}</div>
                <v-text-field
                    type="number"
                    label="Position y (px)"
                    hide-details="auto"
                    class="mb-3"
                    v-model="form.position_y"
                ></v-text-field>
                <div class="mb-2 text-danger" v-if="form.errors.position_y">{{ form.errors.position_y[0] }}</div>
                <v-text-field
                    type="number"
                    label="Activity"
                    hide-details="auto"
                    class="mb-3"
                    v-model="form.activity"
                ></v-text-field>
                <div class="mb-2 text-danger" v-if="form.errors.activity">{{ form.errors.activity[0] }}</div>
                <v-select
                    label="Product"
                    :items="products"
                    item-value="id"
                    item-title="name"
                    v-model="form.product_id"
                ></v-select>
                <div class="mb-2 text-danger" v-if="form.errors.product_id">{{ form.errors.product_id[0] }}</div>
                <div class="d-flex justify-content-between mt-5">
                    <v-btn @click="back">Cancel</v-btn>
                    <v-btn type="submit" color="green">{{ label }}</v-btn>
                </div>
            </form>
        </v-container>
    </App>
</template>

<script>
import App from "../../Layouts/App.vue"
import { router, useForm } from '@inertiajs/vue3'

export default {
    components: {App},
    props: {
        products:{type:Array},
        hotpoint:{type:Array},
    },
    data () {

        const label = this.hotpoint ? 'Update' : 'Create';

        return {
            form: useForm({
                id: this.hotpoint ? this.hotpoint.id : null,
                name:this.hotpoint ? this.hotpoint.name : null,
                position_x: this.hotpoint ? this.hotpoint.position_x :null,
                position_y: this.hotpoint ? this.hotpoint.position_y :null,
                product_id: this.hotpoint ? this.hotpoint.product_id :null,
                activity: this.hotpoint ? this.hotpoint.activity :null,
            }),
            label: label,
        }
    },
    methods: {
        submit() {
            if(this.hotpoint) {
                this.form.put(route('hotpoints.update', this.hotpoint.id))
            } else {
                this.form.post(route('hotpoints.store'))
            }
        },
        back() {
            router.visit(route('hotpoints.index'))
        }
    }
}
</script>

<style scoped>

</style>
