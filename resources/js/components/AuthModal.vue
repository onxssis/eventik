<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      feedback: "",
      loading: false
    };
  },
  methods: {
    login() {
      this.loading = true;

      axios
        .post("/login", this.form)
        .then(() => location.reload())
        .catch(e => {
          this.feedback = e.response.data.message;
          this.loading = false;
        });
    },
    hideModal() {
      this.$modal.hide("login");
    }
  }
};
</script>

<style scoped>
.feedback {
  border-radius: 4px;
}
</style>
