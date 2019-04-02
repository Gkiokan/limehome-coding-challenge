<template lang="html">
    <div class='places'>

        <h2 class='mb-4'> List of all found properties near by </h2>

        <div class='row'>
            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xxl-3 each_item' v-for="(place, i) in places" :key="'_places_list_item_' + i">

                <div class="card">
                    <div class='card-img-top image' :class="image_filter_class" :style="'background-image: url(' + place.photos[0].url + ');'">
                      <div class='open_now' v-if="place.opening_hours"> open now </div>
                      <div class='stars'>
                          <template v-for="n in place.rating | roundUp">
                            <fa icon="star" color="gold" />
                          </template>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class='description'>
                            <h5 class="card-title"> {{ place.name }}</h5>
                            <p class="card-text"> {{ place.vicinity }}</p>
                        </div>

                        <div class='actions'>
                            <div class='btn btn-info btn-xs btn-sm'> <fa icon="eye" /> Details </div>
                            <div class='btn btn-success btn-xs btn-sm'> <fa icon="door-open" /> Check-In </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'PlacesCard',
    props: ['places'],

    data(){ return {
        show_images: true,
        image_filter_class: 'image_filter_red', // choose between image_filter_red, image_filter_green, image_filter_pink
    }},

    filters: {
        roundUp(val){
            console.log(val)
            let number = Math.round(val)
            return number
        }
    },

    mounted(){

    }
}
</script>

<style lang="scss" scoped>

  .each_item {
    margin-bottom: 30px;
  }

  .card {
      height: 100%;
      border: none;
      border-radius: 5px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      cursor: pointer;

      .image {
          position: relative;
          height: 0px;
          padding-bottom: 56.25%;
          background: center center no-repeat;
          background-size: cover;

          &:after {
              content: '';
              position: absolute; z-index: 10;
              top: 0; right: 0; top: 0; bottom: 0;
              display: block;
              width: 100%; height: 100%;
              opacity: .2;
              transition: all .6s;
          }

          .stars {
              position: absolute; z-index: 15;
              top: 2px; left: 5px;
          }

          .open_now {
              position: absolute; z-index: 15;
              top: 0; right: 0;
              background: darkgreen;
              color: white;
              font-size: 12px;
              padding: 4px 10px;
              border-radius: 0px 5px 0px 5px;
          }
      }

      .card-body {
          display: flex;
          flex-direction: column;
          justify-content: space-between;

          .description {
              margin-bottom: 20px;
          }
      }


      &:hover {
          .image {
              &:after {
                  opacity: 0;
              }
          }
      }
  }
</style>
