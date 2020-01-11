<template>
  <article>
    <div class="cont">
      <div class="img-hold" :style="eventImgStyles">
        <!-- <img :src="event.image" :alt="event.title" /> -->
        <div class="free" v-if="free">Free</div>
      </div>
      <div class="aside">
        <h4>{{ event.title }}</h4>
        <div>
          <p>{{ event.formattedStartDate }}</p>
          <p>{{ event.address }}</p>
          <p v-html="event.formattedPrice"></p>
        </div>
        <div class="button-container">
          <div>
            <ShareButton />
          </div>

          <div>
            <LikeButton />
          </div>
        </div>
      </div>
    </div>
  </article>
</template>


<script>
import ShareButton from "./Share";
import LikeButton from "./Like";
export default {
  components: {
    ShareButton,
    LikeButton
  },
  props: {
    event: {
      type: Object,
      required: true
    }
  },
  computed: {
    free() {
      return this.event.formattedPrice === "Free";
    },
    eventImgStyles() {
      return {
        backgroundImage: `url(${this.event.image})`
      };
    }
  }
};
</script>

<style lang="scss" scoped>
.button-container {
  display: flex;
  justify-self: end;

  > div:first-child {
    margin-right: 2em;
  }
}

.img-hold {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 6px;
}
</style>