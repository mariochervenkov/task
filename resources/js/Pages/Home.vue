<template>
    <App>
        <div id="home-banner" class="w-100 position-relative overflow-hidden">
            <div class="hotpoint-wrapper" v-for="hotpoint in hotpoints" :style="{ left: hotpoint.position_x + 'px', top: hotpoint.position_y + 'px'}">
                <a href="#" class="icon pulsing popover-trigger" data-html="true" :data-placement="getPopoverPlacement(hotpoint)" data-toggle="popover" :data-content="getPopoverContent(hotpoint)"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
        </div>
    </App>
</template>

<script>

import App from "../Layouts/App.vue"
import {useForm} from "@inertiajs/vue3";

export default {
    components: {App},
    props: {
        hotpoints:{type:Array},
    },
    data () {
        return {
            position_y_top_min: 150,
            position_y_bottom_max: 100,
        }
    },
    mounted() {
        $(document).ready(function(){

            const $popoverElements = $('[data-toggle="popover"]')
            // Trigger Popovers
            $popoverElements.popover()

            // Close all popovers except this
            $popoverElements.on('click', function (e) {
                e.preventDefault()
                $popoverElements.not(this).popover('hide')
            });

            $('body').on('click', function (e) {
                const $clickedEl = $(e.target)
                console.log($clickedEl)
                if (
                    $clickedEl.parents('.popover-body').length === 0 &&
                    !$clickedEl.hasClass('popover-trigger')
                )
                {
                    $popoverElements.popover('hide')
                }
            });
        });
    },
    methods: {
        getPopoverContent(obj) {
            const rating = this.getRating(obj.product.rating)

            return '<div class="row p-3" style="width: 300px">' +
                '<div class="col-md-4">' +
                '<img src="' + obj.product.image_path +'" class="img-fluid">' +
                '</div>' +
                '<div class="col-md-8">' +
                '<h4>' + obj.name +'</h4>' +
                '<div class="d-flex mb-4 align-items-center">' +
                '<div class="me-4">' + rating + ' <span class="rating">' + obj.product.rating +'</span></div><div><i class="fa-solid fa-cart-shopping"></i> ' + obj.activity + ' пъти</div>' +
                '</div>' +
                '<div class="d-flex align-items-center">' +
                '<div class="me-4 font-weight-bold text-danger fs-26">' + obj.product.price + ' лв.</div><div class="fs-26"><a href="#" class="btn btn-outline-danger text-black font-weight-bold popover-button"><i class="fa-solid fa-cart-shopping"></i> КУПИ</a></div>' +
                '</div>' +
                '</div></div>';
        },
        getRating(rating) {
            let totalRating = 5
            let output = ''

            for (let i = 1; i <= rating; i++) {
                output += '<i class="fa-solid fa-star fa-star-checked me-1"></i>'
                totalRating--
            }

            if(totalRating > 0) {
                for (let i = 1; i <= totalRating; i++) {
                    output += '<i class="fa-solid fa-star me-1"></i>'
                }
            }

            return output
        },
        getPopoverPlacement(obj)
        {
            const maxPositionY = window.innerHeight - this.position_y_bottom_max;

            let placement = 'right'

            if(obj.position_y < this.position_y_top_min || obj.position_y > maxPositionY) {
                placement = 'top'
            }

            return placement
        }
    }
}

</script>

<style scoped>

</style>
