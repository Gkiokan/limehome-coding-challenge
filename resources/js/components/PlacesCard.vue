<template lang="html">
    <div class='places card'>

        <h2 class='mb-4'> List of all found properties near by </h2>

        <div class='row'>
            <div class='col-xs-12 col-sm-6 col-md-4' v-for="(place, i) in places" :key="'_places_list_item_' + i">

                <div class="card">
                    <div class='card-img-top image' :style="'background-image: url(' + place.photos[0].url + ');'"></div>
                    <div class="card-body">
                        <h5 class="card-title"> {{ place.name }}</h5>
                        <p class="card-text"> {{ place.vicinity }}</p>

                        <div class='btn btn-info btn-xs'> <fa icon="eye" /> Details </div>
                        <div class='btn btn-success btn-xs'> <fa icon="door-open" /> Check-In </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'PlacesCard',
    props: ['places'],

    data(){ return {
        show_images: true,

    }},

    mounted(){

    }
}
</script>

<style lang="scss" scoped>

</style>
