<template lang="html">
    <div class='page placeinfo'>

        <div class='header' v-if="!disable_simple_header">
            <div class='image image_filter_green' v-if="place && place.photos.length >= 1"
                 :style="'background-image:url('+place.photos[0].url+');'">
                <div class='container'>
                    <div class='title'> {{ place.name }} </div>
                </div>
            </div>
        </div>

        <Carousel :photos="place.photos" :title="place.name" />

        <div class='container mt-4 mb-5'>
            <div class='row'>
                <div class='col-xs-12 col-md-6'>
                    <h2> Property Information </h2>

                    <img :src='img.url' v-for="(img, i) in place.photos" v-if="false"
                         :key="'_image_' + i" style='width: 100%; height: auto;' />
                </div>
                <div class='col-xs-12 col-md-6'>
                    <h3> Booking </h3>

                    ...
                </div>
            </div>
            <pre>{{ placeid }}</pre>
            <pre>{{ place }}</pre>
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
        disable_simple_header: true, // This DOM Element is one way of doing it in a simple way
        placeid: false,
        place: false,
        loaded: false,
    }},

    mounted(){
        if(!this.selected)
          this.$router.push({ name: 'get-started' })

        if(this.$route.params.id){
            this.placeid = this.$route.params.id
            console.log(':: Place ID has been set to ' + this.placeid)
            this.getPlace()
        }
    },

    computed: {
        // selected: get('place/selected')
        selected(){
            return {"geometry":{"location":{"lat":48.1118842,"lng":11.5474643},"viewport":{"northeast":{"lat":48.1133227802915,"lng":11.5487969802915},"southwest":{"lat":48.11062481970851,"lng":11.5460990197085}}},"icon":"https://maps.gstatic.com/mapfiles/place_api/icons/lodging-71.png","id":"ad93f64d7831d719d60fde1bf4088956a540c3cc","name":"Leonardo Hotel München City West","opening_hours":{"open_now":true},"photos":[{"height":1600,"html_attributions":["<a href=\"https://maps.google.com/maps/contrib/110618533510945285289/photos\">Leonardo Hotel München City West</a>"],"photo_reference":"CmRaAAAA39Yh1-K8fAJjhGQZWeFsdIjzZM9J47DDNRCN1rJKilbhKsqJalYLIeNeC0LZdJ0Yc_dDIodAw_P9GVZC8nmbIQsw2WnT5zWJc06RuL_eebnGbxtDsLkTLU-vHPE9zo9oEhALrPTgY-r2G4nBUQoN8qYIGhRNnbfuJ-PnQGi5dS5HweXCFj2M3Q","width":2400,"url":"https://maps.googleapis.com/maps/api/place/photo?photoreference=CmRaAAAA39Yh1-K8fAJjhGQZWeFsdIjzZM9J47DDNRCN1rJKilbhKsqJalYLIeNeC0LZdJ0Yc_dDIodAw_P9GVZC8nmbIQsw2WnT5zWJc06RuL_eebnGbxtDsLkTLU-vHPE9zo9oEhALrPTgY-r2G4nBUQoN8qYIGhRNnbfuJ-PnQGi5dS5HweXCFj2M3Q&sensor=0&maxheight=1080&maxwidth=1920&key=AIzaSyCfWwZlZ6DvTqAzQhgdro8EUI0MyzU3Ztg"}],"place_id":"ChIJm0eWLzHfnUcR9GU9eWxoiKE","plus_code":{"compound_code":"4G6W+QX Munich, Germany","global_code":"8FWH4G6W+QX"},"rating":4.1,"reference":"ChIJm0eWLzHfnUcR9GU9eWxoiKE","scope":"GOOGLE","types":["lodging","point_of_interest","establishment"],"user_ratings_total":563,"vicinity":"Brudermühlstraße 33, München","update":"MAPPING_SUCCESS"}
        }
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

<style lang="scss">
  .header {
      min-height: 400px;

      .image {
          position: relative;
          height: 400px;
          padding-bottom: 0px; // 56.25%; // 16:9 format

          background: center center no-repeat;
          background-size: cover;
          transition: all .6s;
          box-shadow: 0px 0px 15px 0px rgba(0,0,0,.5);

          &:after {
              z-index: 5;
          }

          .container {
              position: absolute;
              background: rgba(0,0,0,.8);
              bottom: 0; left: 0; right: 0;
              z-index: 10;
          }
      }

      .title {
          font-size: 50px;
          font-weight: 100;
          color: #ffff;
      }
  }

</style>
