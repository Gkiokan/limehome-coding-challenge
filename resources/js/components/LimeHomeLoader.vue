<template lang="html">
  <div class="lds-css ng-scope" :class="getClassName()">
      <div class="lds-blocks" style="width:100%;height:100%">
        <div style="left:59px;top:59px;animation-delay:0s"></div>
        <div style="left:101px;top:59px;animation-delay:0.15s"></div>
        <div style="left:59px;top:101px;animation-delay:0.44999999999999996s"></div>
        <div style="left:101px;top:101px;animation-delay:0.3s"></div>
      </div>
  </div>
</template>

<script>
export default {
    name: 'LimeHomeLoader',
    props: ['absolute'],

    data(){
        return {
            isAbsolute: false,
            defaultClassName: ' _NO_POSITION_CLASS',
            finalClassName: 'absolute'
        }
    },

    mounted(){
        // console.log('Loading LimeHomeLoader v0.1')
    },

    methods : {
        getClassName(){
            return this.absolute ? this.finalClassName : this.defaultClassName
        }
    }
}
</script>

<style lang="scss" scoped>
    @keyframes lds-blocks {
        0% {
          background: #80a352;
        }
        25% {
          background: #80a352;
        }
        25.25% {
          background: #64533b;
        }
        100% {
          background: #64533b;
        }
    }

    @-webkit-keyframes lds-blocks {
        0% {
          background: #80a352;
        }
        25% {
          background: #80a352;
        }
        25.25% {
          background: #64533b;
        }
        100% {
          background: #64533b;
        }
    }

    .absolute {
        position: absolute; z-index: 10;
        top: 0; right: 0; left: 0; bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .lds-blocks {
        position: relative;
    }

    .lds-blocks div {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #64533b;
        -webkit-animation: lds-blocks 0.6s linear infinite;
        animation: lds-blocks 0.6s linear infinite;
    }

    .lds-blocks {
        width: 200px !important;
        height: 200px !important;
        -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
        transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
    }
</style>
