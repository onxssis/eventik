<template>
  <article>
    <div class="cont">
      <div class="img-hold">
        <img
          src="https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F56927247%2F2581145421%2F1%2Foriginal.20190216-200149?w=512&auto=compress&rect=0%2C0%2C2160%2C1080&s=acea6956bc433ee106e7096e703ef139"
          alt
        >
        <div class="free" v-if="free">Free</div>
      </div>
      <div class="aside">
        <h4>{{ event.title }}</h4>
        <div>
          <p>{{ event.formattedStartDate }}</p>
          <p>{{ event.address }}</p>
          <p v-html="event.formattedPrice"></p>
        </div>
        <div class="buttons">
          <div>
            <ShareButton/>
          </div>

          <div>
            <LikeButton/>
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
    }
  }
};
</script>
