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
      isActive: this.active,
      isAuth: this.$root.authenticated
    };
  },
  computed: {
    classes() {
      return this.isActive ? "is-danger" : "is-success";
    }
  },
  methods: {
    attendEvent() {
      if (!this.isAuth) return this.$modal.show("login");

      axios[this.isActive ? "delete" : "post"](
        location.pathname + "/reservations"
      )
        .then(() => (this.isActive = !this.isActive))
        .catch(e => {
          if (!this.isAuth) this.$modal.show("login");
        });
    }
  }
};
</script>

<style lang="scss" scoped>
button {
  transition: background-color 0.3s ease-out;
}
</style>
