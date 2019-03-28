<login-modal inline-template v-cloak>
    <modal name="login" transition="pop-out" :classes="['box']" height="auto">

        <header class="modal--header">
            <h1 class="title is-4">Welcome Back!</h1>
            <button @click="hideModal" class="modal-close is-large" aria-label="close"></button>
        </header>

        <br>

        <form @submit.prevent="login">

            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" type="email" placeholder="Email" v-model="form.email" name="email" required>
                    <span class="is-left icon">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" v-model="form.password" type="password" placeholder="Password" name="password" required>
                    <span class="icon is-left">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
            </div>

            <button type="submit" name="login" class="modal__login-button button primary-color" :class="loading ? ' is-loading' : ''">
                LOG IN
            </button>

            <div class="is-divider" data-content="OR"></div>

            <a href="/register" class="button is-fullwidth is-uppercase">Sign Up</a>

            <div class="m-t-md p-xs feedback has-background-danger has-text-white has-text-centered" v-if="feedback">
                <span class="help" v-text="feedback" style="font-size: 16px"></span>
            </div>
        </form>
    </modal>
</login-modal> 