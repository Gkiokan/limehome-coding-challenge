<template lang="html">
    <div class='page placeinfo'>

        <SimplePlaceHeader :place="place" v-if="simple_header" />
        <Carousel :photos="place.photos" :title="place.name" v-if="!simple_header"/>

        <div class='container mt-4 mb-5' v-if="place">
            <div class='row'>
                <div class='col-xs-12 col-md-6'>
                    <h2> Property Information </h2>

                    <div class='property'>
                      <div class='name' v-html="place.name" />
                      <div class='adress' v-html="place.formatted_address_html" />

                      <div class='misc'>
                        <b>Misc</b>
                        <div class='phone' >Phone: {{ place.international_phone_number }}</div>
                        <div class='google_code'>Plus Code: {{ place.plus_code.global_code }}</div>
                        <div class='place_id'>Place ID: {{ place.place_id }}</div>
                      </div>

                      <b>Opening Hours </b>
                      <div class='opening_hours' v-html="place.opening_hours.formatted_weekday_text_html" />
                    </div>

                </div>
                <div class='col-xs-12 col-md-6'>
                    <h3> Booking </h3>

                    <BookingForm :id="placeid" />
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { get, sync, call } from 'vuex-pathify'
import axios from 'axios'

export default {
    layout: 'full',

    data(){ return {
        title: 'Selected Property for booking In',
        simple_header: false, // choose between simple Header or BS4 Carousel
        placeid: false,
        place: false,
        loaded: false,
    }},

    mounted(){
        // when we have no id given, just get back to the list
        if(!this.$route.params.id)
          this.$router.push({ name: 'get-started' })

        // explicitly check for the id (simplest way), set it and give it a go
        if(this.$route.params.id){
            this.placeid = this.$route.params.id
            console.log(':: Place ID has been set to ' + this.placeid)
            this.getPlace()
        }
    },

    computed: {
        // selected: get('place/selected')
    },

    methods: {
        getPlace(){
            if(!this.placeid){
                console.log(':: NO PLACE ID FOUND!')
                return
            }

            console.log(':: Request Place Information by ID ' + this.placeid)
            axios.get('/api/getPlace/' + this.placeid)
                 .then( r => {
                      console.log(':: Place Object found')
                      console.log(r.data.response)
                      this.place = r.data.response.result
                      this.loaded = true
                 })
        }
    }
}
</script>

<style lang="scss" scoped>
    .property {
        .name {
            font-weight: bold;
        }

        .adress,
        .misc,
        .opening_hours {
            margin-bottom: 20px;
        }

    }

</style>
