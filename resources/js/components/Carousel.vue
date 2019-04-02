<template lang="html">
  <div class='bs4_simple_slider'>
    <div :id="id" class="carousel slide" data-ride="carousel">
        <div class='container overlay'>
            <div class='title'> {{ title }} </div>

            <ol class="carousel-indicators">
              <li v-for="(item, i) in photos"
                  :key="'ol_items' + i"
                  :data-target="'#' + id"
                  :data-slide-to="i"
                  :class="{ active : (i == 0) }"></li>
            </ol>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item"
               v-for="(item, i) in photos"
               :key="'carousel_item_' + i"
               :class="{ active : (i == 0) }"
            >
            <div class='image' :style="'background-image:url('+item.url+');'"></div>
          </div>
        </div>

        <a class="carousel-control-prev" :href="'#'+id" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" :href="'#'+id" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Carousel',
    props: ['photos', 'title'],

    data(){ return {
        id : '',
    }},

    mounted(){
        this.id = this.generateID()
    },

    methods: {
        generateID(){
            let num = Math.random().toString(36).substr(2, 5);
            return 'slider_' + num
        }
    }

}
</script>

<style lang="scss" scoped>
  .bs4_simple_slider {
      position: relative;
      box-shadow: 0px 0px 15px 0px rgba(0,0,0,.5);
  }

  .carousel-inner {
      position: relative; z-index: 10;
      height: 500px;

      .carousel-item {
          height: 100%;
          background: gray;

          .image {
              position: absolute;
              top: 0; left: 0; right: 0; bottom: 0;
              display: block;
              width: 100%; height: 100%;
              background: center center no-repeat;
              background-size: cover;
          }
      }
  }

  .overlay.container {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0,0,0,.8);
      z-index: 20;
      color: white;
      font-size: 50px;
      font-weight: 100;
      line-height: 1.1;
      padding-bottom: 30px;
      padding-top: 10px;

      .carousel-indicators {
          z-index: 20;
          bottom: 0; right: auto;
          margin-left: 15px;
      }
  }

  .carousel-control-prev,
  .carousel-control-next {
      z-index: 15;
  }
</style>
