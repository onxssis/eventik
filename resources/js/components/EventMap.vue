<template>
  <div class="event-map">
    <div class="switch">
      <Toggle @switchToggle="toggleDarkMode" :checked="mode === 'dark'" />
    </div>
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
      fullscreenControl: false,
      styles
    }"
    >
      <GmapMarker
        :key="index"
        v-for="(m, index) in mapMarkers"
        :position="m.position"
        :clickable="true"
        :draggable="false"
        :animation="4"
        :icon="{url: '/images/marker.svg'}"
        @click="center=m.position"
      />

      <div class="search-button" v-if="isSearchable && dragged">
        <button @click="searchArea">Search this area</button>
      </div>
    </GmapMap>
  </div>
</template>

<script>
import gmapStyles from "../gmapStyles";
import FilterMixin from "../mixins/FilterMixin";
import Toggle from "./Toggle";

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
  components: {
    Toggle
  },
  data() {
    return {
      map: null,
      mapMarkers: [],
      dragged: false,
      mode: "null"
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
      return gmapStyles[this.mode];
    }
  },
  // watch: {
  //   mode: {
  //     handler: function(val) {

  //     },
  //     immediate: true
  //   }
  // },
  methods: {
    searchArea() {
      this.applyFilter(
        "r",
        `${this.map.center.lat()},${this.map.center.lng()}`
      );
    },
    toggleDarkMode(mode) {
      if (mode) {
        this.mode = "dark";
        window.localStorage.setItem("map-theme", "dark");
      } else {
        this.mode = "light";
        window.localStorage.setItem("map-theme", "light");
      }
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
    this.mode = window.localStorage.getItem("map-theme") || "light";
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

.switch {
  margin-bottom: 1rem;
  display: flex;
  justify-content: flex-end;
}

::v-deep .vue-map-hidden {
  display: block !important;
}
</style>