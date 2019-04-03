<template>
  <card :title="'Dashboard'">

    <div class='profile_check' v-if="user">

        <div class='alert alert-info' v-if="!user.firstname || !user.lastname || !user.mobile">
            Hi {{ user.name }}, <br>
            <br>
            Please fill in your <b>firstname, lastname and mobile</b>.<br>
            Thoose Information will be autofilled for you, whenever you book a property. <br>
            <br>
            Your DEV Team.
        </div>

        <div v-else class='alert alert-success'>
            Hi {{ user.firstname }} {{ user.lastname }} <small>({{ user.name }})</small>,<br>
            you are all set. Happy booking!<br>
        </div>


        <div class='booking_information'>
            <div class="d-flex justify-content-center" v-if="loading">
              <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>

            You have <b>{{ bookings.length }}</b> Booking.<br>
            <br>
            <pre>{{ bookings }}</pre>

        </div>

    </div>
    <br>
    <br>
    <b>Your User Object </b>
    <pre>{{ user }}</pre>
  </card>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  middleware: 'auth',

  metaInfo () {
      return { title: "My Dashboard" }
  },

  data(){ return {
      loading: true,
      bookings: []
  }},

  mounted(){
      this.loadBookingInformation()
  },

  computed: mapGetters({
      user: 'auth/user'
  }),

  methods: {
      loadBookingInformation(){
          if(!this.user) {
              console.log(":: User not set, abboard getting Booking Information")
          }

          axios.get('/api/users/' + this.user.id + '/bookings')
               .then( r => {
                    this.bookings = r.data.bookings
                    this.loading  = false
               })
      }
  }

}
</script>

<style lang='scss' scoped>
    .alert {
        border-radius: 0px;
    }
</style>
