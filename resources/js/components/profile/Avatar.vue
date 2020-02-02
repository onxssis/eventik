<template>
  <div class="avatar">{{ initials }}</div>
</template>

<script>
export default {
  props: ["name"],
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