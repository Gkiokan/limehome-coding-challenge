<template lang="html">
    <div class='places'>

        <h2 class='mb-4'> List of all found properties near by </h2>

        <table class='table table-bordered- table-hover'>
        <thead>
          <tr>
              <th>Place Name </th>
              <th class='text-right'>Options </th>
          </tr>
        </thead>
        <tbody>
            <tr class='item' v-for="(place, i) in places" :key="'_places_list_item_' + i">
                <td>
                    <div class='description'>
                        <div class='name'> {{ place.name}} </div>
                        <div class='adress'> {{ place.vicinity }} </div>
                        <div class='image'  :style="'background-image: url(' + place.photos[0].url + ');'"></div>
                    </div>
                </td>
                <td class='text-right'>
                    <div class='btn btn-info btn-xs'> <fa icon="eye" /> Details </div>
                    <div class='btn btn-success btn-xs'> <fa icon="door-open" /> Check-In </div>
                </td>
            </tr>
        </tbody>
        </table>

    </div>
</template>

<script>
export default {
    name: 'PlacesList',
    props: ['places'],

    data(){ return {
        show_images: true,

    }},

    mounted(){

    }
}
</script>

<style lang="scss" scoped>
  $image_size: 200px;
  $min_height: 120px;

  .adress {
      font-size: 80%;
      color: #888;
  }

  .description {
      position: relative;
      padding-left: $image_size + 20px;
      min-height: $min_height;

      .image {
          position: absolute;
          left: 0px; top: 0px; bottom: 0px;
          width: $image_size; height: 100%;
          background: center center no-repeat;
          background-size: cover;
          box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.8);
          border: 1px solid white;
      }

      @media (max-width: 768px){
          $image_size: 120px;
          padding-left: $image_size + 10px;

          .image {
              width: $image_size;
          }
      }
  }
</style>
