<template>
  <a class="button" @click="toggle">
    <span class="icon is-small">
      <i :class="classes"></i>
    </span>
  </a>
</template>

<script>
export default {
  props: ["bookmarked", "id"],
  data() {
    return {
      isBookmarked: this.bookmarked
    };
  },
  computed: {
    classes() {
      return [
        this.isBookmarked
          ? "fas fa-bookmark has-text-danger"
          : "far fa-bookmark"
      ];
    },
    url() {
      return `/events/${this.id}/bookmark`;
    }
  },
  methods: {
    toggle() {
      if (!this.$root.authenticated) return this.$modal.show("login");

      let method = this.isBookmarked ? "delete" : "post";

      axios[method](this.url).then(() => {
        this.isBookmarked = !this.isBookmarked;
        location.reload();
      });

      // if (this.isBookmarked) {
      //   axios.delete(this.url).then(() => (this.isBookmarked = false));
      // } else {
      //   axios.post(this.url).then(() => (this.isBookmarked = true));
      // }
    }
  }
};
</script>
