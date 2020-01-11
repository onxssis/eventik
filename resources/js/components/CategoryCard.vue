<template>
  <div class="cat-card-wrap">
    <a :href="`/b?cat=${data.slug}`">
      <div class="cat-card">
        <div class="card-bg" :style="cardBgStyles"></div>
        <div class="card-info">{{ data.name }}</div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      required: true
    }
  },
  computed: {
    cardBgStyles() {
      return {
        backgroundImage: `url(${this.data.image})`
      };
    }
  }
};
</script>

<style lang="scss" scoped>
.cat-card-wrap {
  transform: perspective(800px);
  cursor: pointer;
  transform-style: preserve-3d;
  margin: 10px;

  &:hover {
    .card-bg {
      opacity: 0.3;
    }
  }
}

.cat-card {
  width: 340px;
  height: 240px;
  position: relative;
  flex: 0 0 340px;
  margin: 10px auto;
  background: #333;
  border-radius: 10px !important;
  overflow: hidden;
  box-shadow: rgba(0, 0, 0, 0.66) 0 0px 15px 0, inset #333 0 0 0 5px,
    inset rgba(255, 255, 255, 0.5) 0 0 0 6px;
  transition: all 0.3s;

  &:hover {
    transform: translateY(-6px);
  }

  &:last-child {
    margin-right: 10px;
  }

  .card-bg {
    background-repeat: no-repeat;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0.5;
    background-size: cover;
    width: 100%;
    height: 100%;
  }

  .card-info {
    color: #fff;
    position: absolute;
    bottom: 25%;
    left: 25px;
    right: 25px;
    font-size: 2em;
    font-weight: bold;
    text-transform: capitalize;
  }
}
</style>