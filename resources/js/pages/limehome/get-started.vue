<template>
  <div class='page get-started'>

      <div class='row no-gutters'>
        <div class='col'>
          <div class='map'>

              <LimeHomeLoader :absolute="true" />

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
  }
}
</script>

<style lang='scss' scoped>
.map {
    height: 500px;
    background: darkgray;
}
</style>
