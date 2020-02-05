<template>
  <div class="container event-data">
    <Event v-for="event in events" :key="event.id" :event="event" />
    <p class="has-text-centered has-text-weight-bold" v-if="events.length < 1">No entries found</p>
  </div>
</template>

<script>
import Event from "../browse/Event";
export default {
  props: {
    events: {
      type: Array,
      required: true
    }
  },
  components: {
    Event
  }
};
</script>

<style scoped>
.event-data {
  max-width: 900px;
}
</style>