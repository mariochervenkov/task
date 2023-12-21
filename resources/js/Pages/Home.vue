<template>
    <App>
        <div id="home-banner" class="w-100 position-relative">
            <div class="hotpoint-wrapper" v-for="hotpoint in hotpoints" :style="{ left: hotpoint.position_x + 'px', top: hotpoint.position_y + 'px'}">
                <i tabindex="0" :id="'hotpoint-popover-' + hotpoint.id" class="icon pulsing hotpoint-popover">x</i>
            </div>
        </div>
    </App>
</template>

<script>
import App from "../Layouts/App.vue"

export default {
    components: {App},
    props: {
        hotpoints:{type:Array},
    },
    mounted () {
        this.hotpoints.forEach((obj, index) => {

            const rating = this.getRating(obj.product.rating)
            console.log(rating)
            new bootstrap.Popover(document.querySelector('#hotpoint-popover-' + obj.id), {
                html: true,
                content: function() {
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
                                '<div class="me-4 font-weight-bold text-danger fs-26">' + obj.product.price + ' лв.</div><div class="fs-26"><a href="#" class="btn btn-outline-danger text-black font-weight-bold"><i class="fa-solid fa-cart-shopping"></i> КУПИ</a></div>' +
                            '</div>' +
                        '</div></div>';
                },
                trigger: 'hover'
            })
        });
    },
    methods: {
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
        }
    }
}
</script>

<style scoped>

</style>
