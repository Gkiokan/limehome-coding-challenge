<template>
  <div class="row">
    <div class="col m-auto">

        <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
              <has-error :form="form" field="email"/>
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left">{{ $t('password') }}</label>
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
              <has-error :form="form" field="password"/>
            </div>
          </div>

          <!-- Remember Me -->
          <div class="form-group row">
            <div class="col-md-3"/>
            <div class="col-md-7 d-flex">
              <checkbox v-model="dsgvo" name="dsvgo">
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

export default {
  middleware: 'guest',
  name: 'BookingForm',
  props: ['id'],

  data: () => ({
      form: new Form({
        user_id : '',
        email: '',
        password: ''
      }),
      dsgvo: false
  }),

  computed: {
      user: get('user/auth')
  },

  methods: {
    async submit () {

        // const { data } = await this.form.post('/api/login')
        this.form.post('/api/booking/' + this.id)
                 .then( r => console.log )

    }
  }
}
</script>
