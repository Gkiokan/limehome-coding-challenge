<template>
  <card :title="$t('home')">
    WELCOME
  </card>
</template>

<script>
export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
