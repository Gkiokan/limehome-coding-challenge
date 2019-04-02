<template lang="html">
      <div class='debug'>
          <card :title="'Debug Object'">
            <template v-if="each">
                <div class='place' v-for="(obj, i) in object" :key="'_place_' + i">
                    <pre>{{ obj }}</pre>
                </div>
            </template>
            <template v-else>
                <pre>{{ object }}</pre>
            </template>
          </card>
      </div>
</template>

<script>
export default {
    name: 'DebugObject',
    props: ['object', 'each']
}
</script>
