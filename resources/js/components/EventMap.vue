<template>
  <GmapMap
    :center="{lat: latitude, lng: longitude}"
    ref="mapRef"
    :zoom="zoom"
    @dragend="dragged = true"
    :style="`width: ${width}; height: ${height};`"
    :options="{
      zoomControl: true,
      mapTypeControl: false,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: false
    }"
  >
    <GmapMarker
      :key="index"
      v-for="(m, index) in mapMarkers"
      :position="m.position"
      :clickable="true"
      :draggable="false"
      :icon="{url: '/images/marker.svg'}"
      @click="center=m.position"
    />

    <div class="search-button" v-if="isSearchable && dragged">
      <button @click="searchArea">Search this area</button>
    </div>
  </GmapMap>
</template>

<script>
import gmapStyles from "../gmapStyles";
import FilterMixin from "../mixins/FilterMixin";

export default {
  mixins: [FilterMixin],
  props: {
    lng: {
      type: Number,
      required: true
    },
    lat: {
      type: Number,
      required: true
    },
    zoom: {
      type: Number,
      default: 13
    },
    events: {
      type: Array
    },
    isSearchable: {
      type: Boolean,
      default: false
    },
    width: {
      type: String,
      default: "100%"
    },
    height: {
      type: String,
      default: "100%"
    }
  },
  data() {
    return {
      map: null,
      mapMarkers: [],
      dragged: false
    };
  },
  computed: {
    latitude() {
      return Number(this.lat);
    },
    longitude() {
      return Number(this.lng);
    },
    styles() {
      return gmapStyles;
    }
  },
  methods: {
    searchArea() {
      this.applyFilter(
        "r",
        `${this.map.center.lat()},${this.map.center.lng()}`
      );
    }
  },
  watch: {
    events: {
      handler: function(val) {
        this.mapMarkers = val.map(event => {
          return {
            position: {
              lat: Number(event.location.lat),
              lng: Number(event.location.lng)
            }
          };
        });
      },
      immediate: true
    }
  },
  mounted() {
    this.$refs.mapRef.$mapPromise.then(map => (this.map = map));
  }
};
</script>

<style lang="scss" scoped>
.search-button {
  position: absolute;
  right: 50%;
  transform: translateX(50%);
  margin: 1em 0;
  font-family: inherit;

  button {
    padding: 0 1em;
    font-size: 1em;
    height: 45px;
    border-radius: 4px;
    cursor: pointer;
    border: 2px solid #f05337;
    background: #fff;
    transition: all 0.3s;
    position: relative;

    &:hover {
      background: darken($color: #fff, $amount: 2);
      border-color: #e33311;
    }

    &:focus,
    &:active {
      outline: none;
    }

    &:active {
      top: 4px;
    }
  }
}

::v-deep .vue-map-hidden {
  display: block !important;
}
</style>