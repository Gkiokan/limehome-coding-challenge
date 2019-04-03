<template>
  <div class='page get-started'>

      <div class='maps wrapper' :class="{ gainAccess }" v-if="!disableMap">
      <div class='row no-gutters'>
        <div class='col'>
          <div class='map'>

              <LimeHomeLoader :absolute="true" v-if="!gainAccess"/>

              <GmapMap v-if="gainAccess"
                :center="{ lat:location.lang, lng:location.long }"
                :options="mapOptions"
                :zoom="14"
                map-type-id_off="terrain"
                style="width: 100%; height: 500px"
              >
                <GmapMarker
                  :icon="current_icon_src"
                  :position="{ lat: location.lang, lng: location.long }"
                />
                <gmap-cluster>
                    <GmapMarker
                      v-for="(m, index) in markers"
                      :key="index"
                      :title="m.name"
                      :icon_off="m.icon"
                      :position="m.location"
                      :clickable="true"
                      :draggable="false"
                      @click="clickOnMarker(m)"
                    />
                </gmap-cluster>
              </GmapMap>

          </div>
        </div>
      </div>
      </div>


      <div class='container mt-4 mb-5'>

          <template v-if="loaded">
              <PlacesList :places="places"  v-if="show == 'list'" />
              <PlacesCard :places="places" v-if="show == 'card'" />
          </template>
          <template v-else>
              <div class="d-flex justify-content-center" style='height: 150px;'>
                    <LimeHomeLoader :absolute="true" v-if="!gainAccess"/>
              </div>
          </template>

          <DebugObject :object="places" :each="false" v-if="places.length > 0 && showDebug"/>
      </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
    // middleware: 'guest', // you may set this to auth to allow loggedIn users only
    layout: 'full',

    metaInfo () {
        return { title: this.$t('home') }
    },

    data(){
      return {
          show: 'card',
          showDebug: false,
          disableMap: false,
          autoloadPlaces: true,
          current_icon_src: '/current_location.png',
          loaded: false,

          location: {
              lang: '',
              long: '',
          },
          position: null,
          gainAccess: false,
          permissionForGeolocation: '',

          mapOptions: {
             zoomControl: true,
             mapTypeControl: false,
             scaleControl: false,
             streetViewControl: false,
             rotateControl: false,
             fullscreenControl: true,
             disableDefaultUi: false
           },

          request: null,
          places: [],
          markers: [],
          center: false,
      }
    },

    mounted(){
        this.checkAccess()
    },

    methods: {
        checkAccess(){

            if( navigator.permissions ){
                navigator.permissions
                         .query({name:'geolocation'})
                         .then( (result) => {
                              // Will return ['granted', 'prompt', 'denied']
                              console.log(":: Permission on Geolocation: " + result.state);
                              this.permissionForGeolocation = result.state
                              this.getCurrentPosition()
                          });
            }

        },

        getCurrentPosition(){
            if( navigator.geolocation ){
                console.log(":: Running auth request for geolocation")
                navigator.geolocation.getCurrentPosition(this.getCurrentPositionSuccess, this.getCurrentPositionFailed)
            }
        },

        getCurrentPositionSuccess(r){
            console.log(":: Geolocation Access granted, got response")
            console.log(r)

            this.gainAccess = true
            this.position = r

            this.location.lang = r.coords.latitude
            this.location.long = r.coords.longitude

            if(this.autoloadPlaces)
            this.getPlaces()
        },

        getCurrentPositionFailed(e){
            console.log(":: Error while getting access to geolocation")
            console.log(e)
        },

        getPlaces(){
            console.log(':: Loading places though Backend API /api/getPlaces')
            axios.get('/api/getPlaces')
                  .then( r => {
                      this.loaded  = true
                      this.request = r.data
                      this.places  = r.data.places
                      this.markers = r.data.markers
                      console.log(r)

                      // this.setTestMarkers()
                  })
        },

        setTestMarkers(){
          this.markers = [
            {
              position: { lat: this.location.lang, lng: this.location.long }
            },
            {
              position: { lat: 48.1351253, lng: 11.5819805 }
            },
            {
              position: { lat: 48.1118842, lng: 11.5474643 }
            },
          ]
        },

        clickOnMarker(marker){
            console.log(':: Clicked on Marker')
            console.log(marker)

        }

    }


}
</script>
