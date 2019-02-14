<template>
  <button
    @click="attendEvent"
    class="button is-fullwidth-desktop ticker-button p-r-xl p-l-xl"
    v-text="this.isActive ? 'Unregister' : 'Register'"
    :class="classes"
  ></button>
</template>

<script>
export default {
  props: ["active", "eventId"],
  data() {
    return {
      isActive: this.active
    };
  },
  computed: {
    classes() {
      return this.isActive ? "is-danger" : "is-success";
    }
  },
  methods: {
    attendEvent() {
      axios[this.isActive ? "delete" : "post"](location.pathname + '/reservations')
        .then(() => this.isActive = ! this.isActive)
        .catch(e => {
          if (e.response.data.status == 401) return location.replace("/login");
        });
    }
  }
};
</script>
