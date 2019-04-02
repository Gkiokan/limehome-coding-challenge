<template lang="html">
  <div class='header'>
      <div class='image image_filter_green' v-if="place && place.photos.length >= 1"
           :style="'background-image:url('+place.photos[0].url+');'">
          <div class='container'>
              <div class='title'> {{ place.name }} </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: 'SimplePlaceHeader',
    props: ['place'],
}
</script>

<style lang="scss" scoped>
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
