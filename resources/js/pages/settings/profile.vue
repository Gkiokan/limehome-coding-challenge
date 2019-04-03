<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')"/>

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" disabled>
          <has-error :form="form" field="name"/>
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right"> Firstname </label>
        <div class="col-md-7">
          <input v-model="form.firstname" :class="{ 'is-invalid': form.errors.has('firstname') }" class="form-control" type="firstname" name="firstname">
          <has-error :form="form" field="firstname" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right"> Lastname </label>
        <div class="col-md-7">
          <input v-model="form.lastname" :class="{ 'is-invalid': form.errors.has('lastname') }" class="form-control" type="lastname" name="lastname">
          <has-error :form="form" field="lastname" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right"> Mobile </label>
        <div class="col-md-7">
          <input v-model="form.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" class="form-control" type="mobile" name="mobile">
          <has-error :form="form" field="mobile" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">{{ $t('update') }}</v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      firstname: '',
      lastname: '',
      mobile: ''
    })
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
