<template lang="html">
    <div class='page placeinfo'>

        <SimplePlaceHeader :place="place" v-if="simple_header" />
        <Carousel :photos="place.photos" :title="place.name" v-if="!simple_header"/>

        <div class='container' style='padding-left: 0;'>
            <div class='btn' @click="$router.back()"
                 style='background: rgba(0,0,0,.8); color: white; border-radius: 0px 0px 2px 2px;'>
                <fa icon="chevron-left" class='mr-1' /> Back
            </div>
        </div>

        <div class='container mt-4 mb-5' v-if="place">
            <div class='row'>
                <div class='col-xs-12 col-md-6'>
                    <h2> Information </h2>

                    <div class='property' v-if="loaded">
                      <h5 class='mb-3'> Property </h5>
                      <div class='form-group'>
                          <div class='name' v-html="place.name" />
                          <div class='adress' v-html="place.formatted_address_html" />
                      </div>

                      <div class='misc'>
                        <h5 class='mb-3 mt-5'>Misc</h5>
                        <div class='form-group'>
                            <div class='phone' >Phone: {{ place.international_phone_number }}</div>
                            <div class='google_code'>Plus Code: {{ getPlusCode() }}</div>
                            <div class='place_id'>Place ID: {{ place.place_id }}</div>
                        </div>
                      </div>

                      <h5 class='mb-3 mt-5'>Opening Hours </h5>
                      <div class='form-group'>
                        <div class='opening_hours' v-html="getOpeningHours()" />
                      </div>
                    </div>

                </div>
                <div class='col-xs-12 col-md-6'>
                    <h2> Booking </h2>

                    <BookingForm :id="placeid" :place="place" v-if="user "/>

                    <template v-else>
                        <h5 class='mb-3'> Login required </h5>
                        <div class='alert alert-info' style='border-radius:0px;'>
                            Please <router-link :to="{ name: 'login.withCB', params: { id: placeid } }">login</router-link> to book this property.
                        </div>
                    </template>

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
        user: get('auth/user')
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
        },

        getPlusCode(){
            let gpc = ""
            if(this.place.plus_code)
              if(this.place.plus_code.global_code)
                gpc = this.place.plus_code.global_code

            if(!this.place.plus_code)
              this.place.plus_code = { global_code : gpc }

            return gpc;
        },

        getOpeningHours(){
            let hrs = "";
            if(this.place.opening_hours)
              if(this.place.opening_hours.formatted_weekday_text_html)
                hrs = this.place.opening_hours.formatted_weekday_text_html

            if(!this.place.opening_hours)
              this.place.opening_hours = { formatted_weekday_text_html : hrs}

            return hrs
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

    h5 {
        border-bottom: 1px solid #717171;
    }

    .form-group {
        padding-left: 20px;
    }
</style>
