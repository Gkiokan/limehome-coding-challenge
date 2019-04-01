<template>
  <div class="main-layout">
    <navbar/>

    <div class="container-fluid-edge">
      <child/>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
