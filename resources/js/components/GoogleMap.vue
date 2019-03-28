<template>
  <GmapMap
    :center="{lat:this.latitude, lng:this.longitude}"
    :zoom="14"
    style="width: 100%; height: 300px;"
    :options="{
        zoomControl: true,
        mapTypeControl: true,
    }"
  >
    <GmapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      :draggable="true"
      @click="center=m.position"
    />
  </GmapMap>
</template>

<script>
export default {
  props: ["lat", "lng"],
  computed: {
    latitude() {
      return Number(this.lat);
    },
    longitude() {
      return Number(this.lng);
    }
  },
  data() {
    return {
      markers: []
    };
  },
  mounted() {
    console.log(this);
  }
};
</script>
