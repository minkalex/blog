<template>
    <div v-if="data.user" class="d-flex justify-content-end dropdown mb-3">
        <a
            href="#"
            class="d-block link-dark text-decoration-none dropdown-toggle"
            id="dropdownUser2"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="font-size: 85%">
            <li v-for="item of items" :key="item.id">
                <a class="dropdown-item" :href="item.href">{{ item.title }}</a>
            </li>
        </ul>
    </div>
    <div v-else class="d-flex justify-content-end">
        <div class="btn-group mb-5" role="group" aria-label="Basic outlined example">
            <a v-for="item in items" :href="item.href" class="btn btn-outline-success">{{ item.title }}</a>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
    data() {
        return {
            items: []
        }
    },

    props: [
        'data',
    ],

    computed: {
        ...mapGetters([
            'getCurrentUser',
        ]),
    },

    methods: {
        ...mapActions([
            'setNewUser',
        ]),
    },

    mounted() {
        if (this.getCurrentUser && this.getCurrentUser.id !== this.data.user.id)
            this.setNewUser(this.data.user)

        if (null !== this.data.user) {
            this.items = [
                {href: this.data.routes.profile, title: 'Profile'},
                {href: `${this.data.routes.main}/users/${this.data.user.id}/edit`, title: 'Edit'},
                {href: this.data.routes.logout, title: 'Sign out'}
            ]
        } else {
            this.items = [
                {href: `${this.data.routes.main}/login`, title: 'Login'},
                {href: `${this.data.routes.main}/signup`, title: 'Sign-up'}
            ]
        }
    }
}
</script>
