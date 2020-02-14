<template>
  <div
    class="avatar"
    :style="{ width: width + 'px', height: height + 'px', fontSize: `${(width / 2) - 10}px` }"
  >{{ initials }}</div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    width: {
      type: String,
      default: "150"
    },
    height: {
      type: String,
      default: "150"
    }
  },
  computed: {
    initials() {
      const [first, last] = this.name.split(" ");

      return first[0] + last[0];
    }
  }
};
</script>

<style lang="scss" scoped>
.avatar {
  background-color: #bdc3c7;
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 65px;
  width: 150px;
  height: 150px;
}
</style>