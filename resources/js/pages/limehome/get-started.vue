<template>
  <div class='page get-started'>

      <div class='maps wrapper' :class="{ gainAccess }">
      <div class='row no-gutters'>
        <div class='col'>
          <div class='map'>

              <LimeHomeLoader :absolute="true" />

          </div>
        </div>
      </div>
      </div>


      <div class='container mt-4 mb-5'>

          <card :title="'List of Properties'">
            ...
          </card>

      </div>

  </div>
</template>

<script>
export default {
    middleware: 'guest',
    layout: 'full',

    metaInfo () {
        return { title: this.$t('home') }
    },

    data(){
      return {
          location: {
              lang: '',
              long: '',
          },
          position: null,
          gainAccess: false,
          permissionForGeolocation: '',
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
        },

        getCurrentPositionFailed(e){
            console.log(":: Error while getting access to geolocation")
            console.log(e)
        },



    }


}
</script>
