<template>
  <div class="row">
    <div class="col m-auto">

        <form @submit.prevent="submit" @keydown="form.onKeydown($event)">

          <h5 class='mb-3'> Property choosen </h5>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Property </label>
            <div class="col-md-7">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="name" name="name" disabled>
              <has-error :form="form" field="name"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Place ID </label>
            <div class="col-md-7">
              <input v-model="form.place_id" :class="{ 'is-invalid': form.errors.has('place_id') }" class="form-control" type="place_id" name="place_id" disabled>
              <has-error :form="form" field="place_id"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Plus Code </label>
            <div class="col-md-7">
              <input v-model="form.plus_code" :class="{ 'is-invalid': form.errors.has('plus_code') }" class="form-control" type="plus_code" name="plus_code" disabled>
              <has-error :form="form" field="plus_code"/>
            </div>
          </div>


          <h5 class='mt-5 mb-3'> Guest Information </h5>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Firstname </label>
            <div class="col-md-7">
              <input v-model="form.firstname" :class="{ 'is-invalid': form.errors.has('firstname') }" class="form-control" type="firstname" name="firstname">
              <has-error :form="form" field="firstname"/>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Lastname </label>
            <div class="col-md-7">
              <input v-model="form.lastname" :class="{ 'is-invalid': form.errors.has('lastname') }" class="form-control" type="lastname" name="lastname">
              <has-error :form="form" field="lastname"/>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left"> Mobile </label>
            <div class="col-md-7">
              <input v-model="form.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" class="form-control" type="mobile" name="mobile">
              <has-error :form="form" field="mobile"/>
            </div>
          </div>


          <!-- Remember Me -->
          <div class="form-group row">
            <div class="col-md-3"/>
            <div class="col-md-7 d-flex">
              <checkbox v-model="form.data_policy" name="data_policy">
                I accept (the useless) data policy.
              </checkbox>
            </div>
          </div>

          <div class="form-group row_off">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                Book now
              </v-button>
            </div>
          </div>
        </form>

    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { get, sync, call } from 'vuex-pathify'
import swal from 'sweetalert2'

export default {
  middleware: 'guest',
  name: 'BookingForm',
  props: ['id', 'place'],

  data: () => ({
      form: new Form({
          user_id : '',
          name: '',
          adress: '',
          city: '',
          phone: '',

          place_id: '',
          plus_code: '',
          data_policy: '',

          firstname: '',
          lastname: '',
      })
  }),

  mounted(){
      if(!this.user) return
      
      this.mapUserData()
      this.mapData()
  },

  computed: {
      user: get('auth/user')
  },

  methods: {
      mapUserData(){
          this.form.user_id   = this.user.id
          this.form.firstname = this.user.firstname
          this.form.lastname  = this.user.lastname
          this.form.mobile    = this.user.mobile
      },

      mapData(){
          this.form.name     = this.place.name
          this.form.adress   = this.place.formatted_address
          this.form.phone    = this.place.international_phone_number
          this.form.city     = this.getCityFromPlace(this.place)

          this.form.place_id = this.place.place_id
          this.form.plus_code= this.place.plus_code.global_code
      },

      getCityFromPlace(place){
          let city = place.address_components.filter((obj) => {
            return obj.types.includes('locality');
          })[0].long_name;

          return city || "NO_CITY_FOUND"
      },

      validate(){
          return this.form.data_policy
      },

      async submit () {
          // validate
          if(!this.validate()){
              swal('Hups, data policy here!',
                   'Data polity is a required stuff nowadays, just check it. ' +
                   'Nobody really cares about it because everything you do require a request to the WWW, ' +
                   'and everything is hackable....', 'error')
              return
          }

          // modify the formdata
          this.mapData()

          // post it
          this.form.post('/api/booking/' + this.id)
                   .then( r => {
                       console.log(r)
                       swal('Booking complete!', 'Thanks for your booking! <br><br>In a real world application you would get an Email to verify your booking and also would be redirected to payments systems, we just asume we have done this already.', 'success')
                   })

      }
  }
}
</script>

<style lang='scss' scoped>
  h5 {
      border-bottom: 1px solid #717171;
  }

  .form-group {
      padding-left: 20px;
  }

  input[disabled]{
      background: transparent;
      border: none;
  }
</style>
